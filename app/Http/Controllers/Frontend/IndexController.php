<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Models\AboutUs;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Checkout;
use App\Models\Contact as ModelsContact;
use App\Models\Cours;
use App\Models\devis;
use App\Models\Domaineactivite;
use App\Models\Event;
use App\Models\Feedback;
use App\Models\Gamme;
use App\Models\Grandcategory;
use App\Models\History;
use App\Models\Mission;
use App\Models\Moyen;
use App\Models\NewsLetter;
use App\Models\Partenaire;
use App\Models\Passager;
use App\Models\Podcast;
use App\Models\Product;
use App\Models\Reference;
use App\Models\Service;
use App\Models\SolideEx;
use App\Models\Souscategory;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class IndexController extends Controller
{


    public function pushnotification(Request $request)
    {

        $nb_prod = $request->nb_prod;

        $count_now = count(Product::where('status','active')->get());

        if($nb_prod < $count_now){

            $last = Product::latest()->first();
            $title = $last->title;
            $url = route('product.detail',$last->slug);
            $photos = explode(',',$last->photo);
            $img = asset($photos[0]);


            return response()->json(['notify' => true , 'desc' => 'nouveau produit ajouté à notre collection !','title'=>$title,'url'=>$url,'img'=>$img]);

        }
        else{
            return response()->json(['notify' => false , 'desc' => 'no','title'=>'no title new']);
        }


    }


    public function home()
    {

        $partenaires = Partenaire::where(['status' => 'active'])->orderBy('title', 'ASC')->get();

        $feedbacks = Feedback::where(['status' => 'active'])->orderBy('id', 'ASC')->get();

        $blogs = Blog::where(['status' => 'active'])->orderBy('id', 'DESC')->limit('2')->get();

        $hot_products = Product::where(['status' => 'active'])->where(['offre' => 'active'])->where('discount' , '!=' , '0')->where('price' , '!=' , 0)->inRandomOrder()->limit('12')->get();

        $banners = Banner::where(['status' => 'active'])->orderBy('id', 'DESC')->get();

        $grandcats = Grandcategory::where(['status' => 'active'])->inRandomOrder()->limit('3')->get();

        $header_home = "accueil";

        return view('frontend.index', compact(['partenaires','feedbacks','blogs','hot_products','grandcats','banners','header_home']));
    }

    public function aboutUs()
    {


        $about = AboutUs::first();
        $title_page = 'À propos';
        return view('frontend.pages.about-us', compact(['title_page']));
    }


    
    public function tousproducts(Request $request)
    {

        $partenaires = Partenaire::where(['status' => 'active'])->orderBy('title', 'ASC')->get();

        $products = Product::where(['status' => 'active'])->where('price' , '!=' , 0);
        $sort = '';
        if ($request->sort != null) {
            $sort = $request->sort;
        }

        if(isset($_GET['search'])){
            if (!empty($_GET['search'])) {
                $products = $products->where((function ($query) use ($request) {
                    $query->where('title', "like", "%" . $_GET['search'] . "%");
                    $query->orWhere('description', "like", "%" . $_GET['search'] . "%");
                }));
            }
        }

        if(isset($_GET['category'])){
            if (!empty($_GET['category'])) {
                $products = $products->where("grand_cat_id",$_GET['category']);
            }
        }

        if(isset($_GET['marques'])){
            $products = $products->whereIn("marque_id",$_GET['marques']);
        }

        if(isset($_GET['pricerangemin'])){
            $min = $_GET['pricerangemin'];

                $products = $products->where("price",">=",$min);
        }

        if(isset($_GET['pricerangemax'])){

            $max =$_GET['pricerangemax'];

                $products = $products->where("price","<=",$max);
        }

        $count_prod= $products->get();


        if ($sort == 'priceAsc') {
            $products = $products->orderBy('price', 'ASC');
        } elseif ($sort == 'priceDesc') {
            $products = $products->orderBy('price', 'DESC');
        } elseif ($sort == 'titleAsc') {
            $products = $products->orderBy('title', 'ASC');
        } elseif ($sort == 'titleDesc') {
            $products = $products->orderBy('title', 'DESC');
        } else {
            $products = $products->orderBy('id', 'DESC');

        }

        $fisrt12 = $products->limit('12')->get();
        $array_12 = array();

        foreach($fisrt12 as $fisrt122){
            $array_12[] = $fisrt122->id;
        }

        $products = $products->paginate(12);



        $route = 'locaux';

        if ($request->ajax()) {
            $view = view('frontend.layouts._single-product', compact(['products','array_12']))->render();
            return response()->json(['html' => $view]);
        }
        $title_page = "Nos produits";
        return view('frontend.pages.product.tousproducts', compact(['products', 'route', 'title_page','count_prod','partenaires','array_12']));
    }

    public function grandcategoryDetail(Request $request,$slug)
    {
        $partenaires = Partenaire::where(['status' => 'active'])->orderBy('title', 'ASC')->get();

        $category = Grandcategory::where('slug', $slug)->first();

        if ($category) {


            $products = Product::where(['status' => 'active', 'grand_cat_id' => $category->id])->where('price' , '!=' , 0);

            $sort = '';
            if ($request->sort != null) {
                $sort = $request->sort;
            }

            if(isset($_GET['search'])){
                if (!empty($_GET['search'])) {
                    $products = $products->where((function ($query) use ($request) {
                        $query->where('title', "like", "%" . $_GET['search'] . "%");
                        $query->orWhere('description', "like", "%" . $_GET['search'] . "%");
                    }));
                }
            }



            if(isset($_GET['marques'])){
                $products = $products->whereIn("marque_id",$_GET['marques']);
            }

            if(isset($_GET['pricerangemin'])){
                $min = $_GET['pricerangemin'];

                    $products = $products->where("price",">=",$min);
            }

            if(isset($_GET['pricerangemax'])){

                $max =$_GET['pricerangemax'];

                    $products = $products->where("price","<=",$max);
            }


            $count_prod= $products->get();


            if ($sort == 'priceAsc') {
                $products = $products->orderBy('price', 'ASC');
            } elseif ($sort == 'priceDesc') {
                $products = $products->orderBy('price', 'DESC');
            } elseif ($sort == 'titleAsc') {
                $products = $products->orderBy('title', 'ASC');
            } elseif ($sort == 'titleDesc') {
                $products = $products->orderBy('title', 'DESC');
            } else {
                $products = $products->orderBy('id', 'DESC');

            }

            $fisrt12 = $products->limit('12')->get();
            $array_12 = array();

            foreach($fisrt12 as $fisrt122){
                $array_12[] = $fisrt122->id;
            }

            $products = $products->paginate(12);



            $route = 'vendre';

            if ($request->ajax()) {
                $view = view('frontend.layouts._single-product', compact(['products','array_12']))->render();
                return response()->json(['html' => $view]);
            }

            $title_page = $category->title;

            return view('frontend.pages.grandcategory-details', compact(['products', 'route', 'category', 'title_page', 'count_prod','partenaires','array_12']));

        } else {
            return view('errors.404');
        }
    }

    public function categoryDetail(Request $request,$slug)
    {
        $partenaires = Partenaire::where(['status' => 'active'])->orderBy('title', 'ASC')->get();

        $category = Category::where('slug', $slug)->first();

        if ($category) {


            $products = Product::where(['status' => 'active', 'cat_id' => $category->id])->where('price' , '!=' , 0);

            $sort = '';
            if ($request->sort != null) {
                $sort = $request->sort;
            }

            if(isset($_GET['search'])){
                if (!empty($_GET['search'])) {
                    $products = $products->where((function ($query) use ($request) {
                        $query->where('title', "like", "%" . $_GET['search'] . "%");
                        $query->orWhere('description', "like", "%" . $_GET['search'] . "%");
                    }));
                }
            }



            if(isset($_GET['marques'])){
                $products = $products->whereIn("marque_id",$_GET['marques']);
            }

            if(isset($_GET['pricerangemin'])){
                $min = $_GET['pricerangemin'];

                    $products = $products->where("price",">=",$min);
            }

            if(isset($_GET['pricerangemax'])){

                $max =$_GET['pricerangemax'];

                    $products = $products->where("price","<=",$max);
            }


            $count_prod= $products->get();



            if ($sort == 'priceAsc') {
                $products = $products->orderBy('price', 'ASC');
            } elseif ($sort == 'priceDesc') {
                $products = $products->orderBy('price', 'DESC');
            } elseif ($sort == 'titleAsc') {
                $products = $products->orderBy('title', 'ASC');
            } elseif ($sort == 'titleDesc') {
                $products = $products->orderBy('title', 'DESC');
            } else {
                $products = $products->orderBy('id', 'DESC');

            }

            $fisrt12 = $products->limit('12')->get();
            $array_12 = array();

            foreach($fisrt12 as $fisrt122){
                $array_12[] = $fisrt122->id;
            }

            $products = $products->paginate(12);






            $route = 'vendre';

            if ($request->ajax()) {
                $view = view('frontend.layouts._single-product', compact(['products','array_12']))->render();
                return response()->json(['html' => $view]);
            }

            $title_page = $category->title;

            return view('frontend.pages.category-details', compact(['products', 'route', 'category', 'title_page','count_prod','partenaires','array_12']));

        } else {
            return view('errors.404');
        }
    }

    public function souscategoryDetail(Request $request,$slug)
    {
        $partenaires = Partenaire::where(['status' => 'active'])->orderBy('title', 'ASC')->get();

        $category = Souscategory::where('slug', $slug)->first();

        if ($category) {


            $products = Product::where(['status' => 'active', 'child_cat_id' => $category->id])->where('price' , '!=' , 0);

            $sort = '';
            if ($request->sort != null) {
                $sort = $request->sort;
            }

            if(isset($_GET['search'])){
                if (!empty($_GET['search'])) {
                    $products = $products->where((function ($query) use ($request) {
                        $query->where('title', "like", "%" . $_GET['search'] . "%");
                        $query->orWhere('description', "like", "%" . $_GET['search'] . "%");
                    }));
                }
            }



            if(isset($_GET['marques'])){
                $products = $products->whereIn("marque_id",$_GET['marques']);
            }

            if(isset($_GET['pricerangemin'])){
                $min = $_GET['pricerangemin'];

                    $products = $products->where("price",">=",$min);
            }

            if(isset($_GET['pricerangemax'])){

                $max =$_GET['pricerangemax'];

                    $products = $products->where("price","<=",$max);
            }

            $count_prod= $products->get();


            if ($sort == 'priceAsc') {
                $products = $products->orderBy('price', 'ASC');
            } elseif ($sort == 'priceDesc') {
                $products = $products->orderBy('price', 'DESC');
            } elseif ($sort == 'titleAsc') {
                $products = $products->orderBy('title', 'ASC');
            } elseif ($sort == 'titleDesc') {
                $products = $products->orderBy('title', 'DESC');
            } else {
                $products = $products->orderBy('id', 'DESC');

            }

            $fisrt12 = $products->limit('12')->get();
            $array_12 = array();

            foreach($fisrt12 as $fisrt122){
                $array_12[] = $fisrt122->id;
            }

            $products = $products->paginate(12);

            $route = 'vendre';

            if ($request->ajax()) {
                $view = view('frontend.layouts._single-product', compact(['products','array_12']))->render();
                return response()->json(['html' => $view]);
            }

            $title_page = $category->title;

            return view('frontend.pages.souscategory-details', compact(['products', 'route', 'category', 'title_page','count_prod','partenaires','array_12']));

        } else {
            return view('errors.404');
        }
    }


    public function marqueDetail(Request $request,$slug)
    {

        $category = Partenaire::where('slug', $slug)->first();

        if ($category) {


            $products = Product::where(['status' => 'active', 'marque_id' => $category->id])->where('price' , '!=' , 0);

            $sort = '';
            if ($request->sort != null) {
                $sort = $request->sort;
            }
            if(isset($_GET['search'])){
                if (!empty($_GET['search'])) {
                    $products = $products->where((function ($query) use ($request) {
                        $query->where('title', "like", "%" . $_GET['search'] . "%");
                        $query->orWhere('description', "like", "%" . $_GET['search'] . "%");
                    }));
                }
            }




            if(isset($_GET['pricerangemin'])){
                $min = $_GET['pricerangemin'];

                    $products = $products->where("price",">=",$min);
            }

            if(isset($_GET['pricerangemax'])){

                $max =$_GET['pricerangemax'];

                    $products = $products->where("price","<=",$max);
            }


            $count_prod= $products->get();

            if ($sort == 'priceAsc') {
                $products = $products->orderBy('price', 'ASC');
            } elseif ($sort == 'priceDesc') {
                $products = $products->orderBy('price', 'DESC');
            } elseif ($sort == 'titleAsc') {
                $products = $products->orderBy('title', 'ASC');
            } elseif ($sort == 'titleDesc') {
                $products = $products->orderBy('title', 'DESC');
            } else {
                $products = $products->orderBy('id', 'DESC');

            }

            $fisrt12 = $products->limit('12')->get();
            $array_12 = array();

            foreach($fisrt12 as $fisrt122){
                $array_12[] = $fisrt122->id;
            }

            $products = $products->paginate(12);


            //dd($products);
            $route = 'vendre';

            if ($request->ajax()) {
                $view = view('frontend.layouts._single-product', compact(['products','array_12']))->render();
                return response()->json(['html' => $view]);
            }

            $title_page = $category->title;

            return view('frontend.pages.marque-details', compact(['products', 'route', 'category', 'title_page','count_prod','array_12']));

        } else {
            return view('errors.404');
        }
    }







    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->first();
        if ($product) {

            $related_products = Product::where('status','active')->where('price' , '!=' , 0)->where('marque_id' , $product->marque_id)->where('grand_cat_id' , $product->grand_cat_id)->inRandomOrder()->limit('10')->get();

            $actual_link = 'http://' . $_SERVER["SERVER_NAME"];
            $photo = explode(',', $product->photo);
            $meta = '<meta itemprop="name" content="' . $product->title . '">
            <meta itemprop="description" content="' . substr(filter_var($product->description, FILTER_SANITIZE_STRING), 0, 200) . '...">
            <meta itemprop="image" content="' . $actual_link . $photo[0] . '">
            <meta property="twitter:card" content="summary_large_image" />
            <meta property="twitter:url" content="' . $actual_link . '" />
            <meta property="twitter:title" content="' . $product->title . '" />
            <meta property="twitter:description" content="' . substr(filter_var($product->description, FILTER_SANITIZE_STRING), 0, 200) . '..." />
            <meta property="twitter:image" content="' . $actual_link . $photo[0] . '" />
            <meta property="twitter:site" content="@MSpara" />
            <meta property="og:type" content="website" />
            <meta property="og:title" content="' . $product->title . '" />
            <meta property="og:description" content="' . filter_var($product->description, FILTER_SANITIZE_STRING) . '" />
            <meta property="og:image" content="' . $actual_link . $photo[0] . '" />';

            $title_page = $product->title;

            return view('frontend.pages.product.product-detail', compact(['product', 'meta', 'title_page','related_products']));
        } else {
            return view('errors.404');
        }
    }

    public function blogList(Request $request)
    {
        $blogs = Blog::where(['status' => 'active'])->orderby('id','DESC')->get();

        $route = 'blog';
        $title_page = 'Nos articles';

        return view('frontend.pages.actualite', compact(['blogs', 'route', 'title_page']));
    }

    public function blogDetail($slug)
    {
        $blog = Blog::where('slug', $slug)->first();

        if ($blog) {

        $related_blogs = Blog::limit("3")->orderby('id','DESC')->get();

        $actual_link = 'http://' . $_SERVER["SERVER_NAME"];
        $meta = '<meta itemprop="name" content="' . $blog->title . '">
        <meta itemprop="description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '...">
        <meta itemprop="image" content="' . $actual_link . $blog->photo . '">
        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" content="' . $actual_link . '" />
        <meta property="twitter:title" content="' . $blog->title . '" />
        <meta property="twitter:description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '..." />
        <meta property="twitter:image" content="' . $actual_link . $blog->photo . '" />
        <meta property="twitter:site" content="@MSpara" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="' . $blog->title . '" />
        <meta property="og:description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '..." />
        <meta property="og:image" content="' . $actual_link . $blog->photo . '" />';
        $title_page = $blog->title;

            return view('frontend.pages.blog-details', compact(['blog', 'meta', 'title_page','related_blogs']));
        } else {
            return view('errors.404');
        }
    }

    public function contactUs()
    {
        $title_page = 'Contacter-nous';
        return view('frontend.pages.contact-us',compact(['title_page']));
    }

    public function contactSubmit(Request $request)
    {
        $this->validate($request, [
            'name' => 'string|required',
            'lastname' => 'string|required',
            'email' => 'string|required',
            'phone' => 'string|required',
            'subject' => 'string|required',
            'content' => 'string|required',
        ]);

        $honeypot = FALSE;
        if (!empty($request->contact_me_by_fax_only) && (bool) $request->contact_me_by_fax_only == TRUE) {

            $honeypot = TRUE;
            log_spambot($_REQUEST);
            header("location : https://google.com/");

        }else{
            $data = $request->all();

            ModelsContact::create($data);

            Mail::send('mail/contact', $data, function ($message) use ($data) {
                    $message->to(get_setting('email'))
                        ->from($data['email'])->subject($data['subject']);
                });

            return back()->with('success', 'Votre message a été envoyé avec succès');
        }
    }

    public function checkout(Request $request)
    {

        $data = $request->all();

        if($request->authi == "yes"){
            $data['sess_id'] = Auth::user()->id;

            $data['reduction_points']=((Auth::user()->points_convertie/100)*2);

            $user = User::find(Auth::user()->id);

            $points_convertie = 0;
            $points_utilise = $user->points_utilise + Auth::user()->points_convertie;

            $user->update([
                'points_convertie' => $points_convertie,
                'points_utilise' => $points_utilise,
            ]);


        }else{

            $data_pass = $request->all();

            $data_pass['full_name'] = $request->nom." ".$request->prenom;

            $status_pass = Passager::create($data_pass);
            if($status_pass){

                $data['pass_id'] = $status_pass->id;
            }
        }



        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);

        $array_prods = array();
        $array_quantity = array();
        $array_prix = array();

        foreach ($cart_data as $keys => $values) {

            $array_prods[]= $cart_data[$keys]["item_id"] ;
            $array_quantity[]= $cart_data[$keys]["item_quantity"] ;

            $product = Product::where('id', $cart_data[$keys]["item_id"])->first();
            $array_prix[]=($product->price-$product->discount);

        }

        $data['prod_ids'] = implode('/',$array_prods);
        $data['quantite'] = implode('/',$array_quantity);
        $data['prix'] = implode('/',$array_prix);



        // return $data;
        $status = Checkout::create($data);
        if ($status) {
            $cart_data = array();
            $item_data = json_encode($cart_data);
            $minutes = 1440;
            Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
            return redirect()->route('merci')->with('success', 'Commande a été passée avec succès');
        } else {
            return back()->with('error', 'something went wrong!');
        }
    }

    public function showLoginForm()
    {

        if (!(Auth::user())) {
            $title_page = "Se connecter";
            return view('frontend.auth.login', compact(['title_page']));
        } else {
            return view('errors.404');
        }
    }


    public function showPasswordForm()
    {

        if (!(Auth::user())) {
            $title_page = "Modifier mot de passe";
            return view('frontend.auth.forget-password', compact(['title_page']));
        } else {
            return view('errors.404');
        }
    }

    public function password(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required'
        ]);
        $user = User::where('email',$request->email)->first();
        if ($user) {


            $to = $request->email;
            $word = Str::random(10);

            $data['password']= Hash::make($word);

            $text = 'Votre nouveau mot de passe est = '.$word;

            Mail::raw($text, function ($message) use ($to) {
                $message->to($to)->subject('Mot de passe modifié');
            });


            $status = $user->fill($data)->save();

            if($status){

                return redirect()->back()->with('success', 'Mot de passe bien modifié , vous trouverez votre nouveau mot de passe dans votre boite de réception ');

            }else{

                return back()->with('error', 'Something went wrong !!!');
            }

        } else {
            return redirect()->route('seller.password.forget')->with('errorpass', "Cet Email n'a aucun compte dans notre site web !");
        }
    }


    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required',
            'password' => 'required'
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'])) {
            //Session::put('user', $request->email);
            $_SESSION['user'] = $request->email;

            return redirect()->route('home')->with('success', 'Vous êtes maintenant connecté sur votre compte');
        } else {
            return redirect()->route('seller.login.form')->with('errorpass', 'Vérifier email ou mot de passe');
        }
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'string|required',
            'gouvernorat' => 'string|required',
            'address' => 'string|required',
            'email' => 'email|required|unique:users,email',
            'password' => 'min:4|required',
            'phone' => 'min:8|max:8',
        ]);

        $data = $request->all();

        $data['password'] = Hash::make($request->password);
        $data['role'] = "seller";

        // return $data;

        $status = User::create($data);


        if ($status) {
            return redirect()->route('seller.login.form')->with('success', 'Votre compte à été créer avec succès ,vous pouvez se connecter maintenant');
        } else {
            return back()->with('error', 'Something went wrong !!!');
        }
    }








    public function compte()
    {

        if ((Auth::user())) {
            $user = User::find(Auth::user()->id);
            $checkouts = checkout::where(['sess_id'=>Auth::user()->id])->get();
            $title_page = "Mon compte";
            return view('frontend.auth.compte', compact(['user', 'checkouts', 'title_page']));
        } else {
            return view('errors.404');
        }
    }


    public function compteUpdate(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if ($user) {

            $this->validate($request, [
                'full_name' => 'string|required',
                'gouvernorat' => 'string|required',
                'address' => 'string|required',
                'email' => 'email|required',
                'phone' => 'min:8|max:8',
            ]);



            $data = $request->all();

            if (!empty($request->newpass)) {
                $data['password'] =  Hash::make($request->newpass);
            }

            $status = $user->fill($data)->save();


            if ($status) {
                return redirect()->route('seller.compte')->with('success', 'Compte a été bien changé');
            } else {
                return back()->with('error', 'Something went wrong !!!');
            }
        } else {
            return back()->with('error', 'data not found !!!');
        }
    }



    public function commandeDetail($id)
    {
        if ((Auth::user())) {

            $checkout = Checkout::where('id', $id)->first();

            if ($checkout) {
                return view('frontend.auth.commande', compact(['checkout']));
            } else {
                return view('errors.404');
            }

        } else {
            return view('errors.404');
        }
    }


















    public function mesachats()
    {

        if ((Auth::user())) {
            $user = User::find(Auth::user()->id);
            $checkouts = checkout::where(['sess_id'=>Auth::user()->id])->get();
            $array_prods = array();
            foreach($checkouts as $checkout){
                $array_prods[]=$checkout->prod_ids;
            }
            $all_prods = implode(',',$array_prods);
            $all_prods_array = explode(',',$all_prods);
            $cours = Cours::whereIn('id', $all_prods_array)->get();
            $title_page = "Mes achats";



            return view('frontend.auth.mesachats', compact(['user', 'title_page', 'checkouts', 'cours']));
        } else {
            return view('errors.404');
        }
    }





    public function podcasts(Request $request)
    {
        $podcasts = Podcast::where(['status' => 'active'])->orderBy('id', 'DESC')->get();

        $header_home = 'podcasts';
        $title_page = 'Podcast';

        return view('frontend.pages.podcasts', compact(['podcasts', 'header_home','title_page']));
    }

    public function podcastDetail($slug)
    {
        $blog = Podcast::where('slug', $slug)->first();

        if ($blog) {



        $actual_link = 'http://' . $_SERVER["SERVER_NAME"];
        $meta = '<meta itemprop="name" content="' . $blog->title . '">
        <meta itemprop="description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '...">
        <meta itemprop="image" content="' . $actual_link . $blog->photo . '">
        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" content="' . $actual_link . '" />
        <meta property="twitter:title" content="' . $blog->title . '" />
        <meta property="twitter:description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '..." />
        <meta property="twitter:image" content="' . $actual_link . $blog->photo . '" />
        <meta property="twitter:site" content="@Amirameddeb" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="' . $blog->title . '" />
        <meta property="og:description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '..." />
        <meta property="og:image" content="' . $actual_link . $blog->photo . '" />';
        $title_page = $blog->title;

            return view('frontend.pages.podcast-details', compact(['blog', 'meta', 'title_page']));
        } else {
            return view('errors.404');
        }
    }

    public function mescours(Request $request)
    {
        $cours = Cours::where(['status' => 'active'])->whereDate('date_debut', '>' , Carbon::now())->orderBy('id', 'DESC')->get();

        $header_home = 'cours';

        $title_page = 'Mes cours';

        return view('frontend.pages.mescours', compact(['cours', 'header_home', 'title_page']));
    }
    public function coursDetail($slug)
    {
        $blog = Cours::where('slug', $slug)->first();

        if ($blog) {



        $actual_link = 'http://' . $_SERVER["SERVER_NAME"];
        $meta = '<meta itemprop="name" content="' . $blog->title . '">
        <meta itemprop="description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '...">
        <meta itemprop="image" content="' . $actual_link . $blog->photo . '">
        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" content="' . $actual_link . '" />
        <meta property="twitter:title" content="' . $blog->title . '" />
        <meta property="twitter:description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '..." />
        <meta property="twitter:image" content="' . $actual_link . $blog->photo . '" />
        <meta property="twitter:site" content="@Optimaconsult" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="' . $blog->title . '" />
        <meta property="og:description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '..." />
        <meta property="og:image" content="' . $actual_link . $blog->photo . '" />';
        $title_page = $blog->title;

            return view('frontend.pages.cours-details', compact(['blog', 'meta', 'title_page']));
        } else {
            return view('errors.404');
        }
    }
    public function evenements(Request $request)
    {
        $evenements = Event::where(['status' => 'active'])->orderBy('id', 'DESC')->get();

        $header_home = 'evenements';

        return view('frontend.pages.evenements', compact(['evenements', 'header_home']));
    }

    public function moyens(Request $request)
    {
        $moyens = Moyen::where(['status' => 'active'])->orderBy('id', 'ASC')->get();

        $header_home = 'moyens';

        return view('frontend.pages.moyens', compact(['moyens', 'header_home']));
    }

    public function moyen($slug)
    {
        $blog = Moyen::where('slug', $slug)->first();

        if ($blog) {

        $domaines = Domaineactivite::where(['status' => 'active'])->orderBy('id', 'ASC')->get();

        $actual_link = 'http://' . $_SERVER["SERVER_NAME"];
        $meta = '<meta itemprop="name" content="' . $blog->title . '">
        <meta itemprop="description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '...">
        <meta itemprop="image" content="' . $actual_link . $blog->photo . '">
        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" content="' . $actual_link . '" />
        <meta property="twitter:title" content="' . $blog->title . '" />
        <meta property="twitter:description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '..." />
        <meta property="twitter:image" content="' . $actual_link . $blog->photo . '" />
        <meta property="twitter:site" content="@Albaraka" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="' . $blog->title . '" />
        <meta property="og:description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '..." />
        <meta property="og:image" content="' . $actual_link . $blog->photo . '" />';
        $title_page = $blog->title;

            return view('frontend.pages.moyen-details', compact(['blog', 'meta', 'title_page', 'domaines']));
        } else {
            return view('errors.404');
        }
    }

    public function domaines(Request $request)
    {
        $domaines = Domaineactivite::where(['status' => 'active'])->orderBy('id', 'ASC')->get();

        $header_home = 'domaine';

        return view('frontend.pages.domaines', compact(['domaines', 'header_home']));
    }

    public function domaineDetail($slug)
    {
        $blog = Domaineactivite::where('slug', $slug)->first();

        if ($blog) {

        $references = Reference::where(['status' => 'active'])->where(['domaine_id' => $blog->id])->orderBy('id', 'ASC')->get();
        $domaines = Domaineactivite::where(['status' => 'active'])->orderBy('id', 'ASC')->get();

        $actual_link = 'http://' . $_SERVER["SERVER_NAME"];
        $meta = '<meta itemprop="name" content="' . $blog->title . '">
        <meta itemprop="description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '...">
        <meta itemprop="image" content="' . $actual_link . $blog->photo . '">
        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" content="' . $actual_link . '" />
        <meta property="twitter:title" content="' . $blog->title . '" />
        <meta property="twitter:description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '..." />
        <meta property="twitter:image" content="' . $actual_link . $blog->photo . '" />
        <meta property="twitter:site" content="@Optimaconsult" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="' . $blog->title . '" />
        <meta property="og:description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '..." />
        <meta property="og:image" content="' . $actual_link . $blog->photo . '" />';
        $title_page = $blog->title;

            return view('frontend.pages.domaine-details', compact(['blog', 'meta', 'title_page', 'references', 'domaines']));
        } else {
            return view('errors.404');
        }
    }

    public function references(Request $request)
    {
        $references = Reference::where(['status' => 'active'])->orderBy('id', 'DESC');
        if (!empty($_GET['mot-cle'])) {
            $references = $references->where((function ($query) use ($request) {
                $query->where('title', "like", "%" . $_GET['mot-cle'] . "%");
                $query->orWhere('description', "like", "%" . $_GET['mot-cle'] . "%");
            }));
        }

        $references=$references->get();

        $header_home = 'references';

        return view('frontend.pages.references', compact(['references', 'header_home']));
    }

    public function referenceDetail($slug)
    {
        $blog = Reference::where('slug', $slug)->first();

        if ($blog) {

        $domaine = Domaineactivite::where('id', $blog->domaine_id)->first();

        $actual_link = 'http://' . $_SERVER["SERVER_NAME"];
        $meta = '<meta itemprop="name" content="' . $blog->title . '">
        <meta itemprop="description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '...">
        <meta itemprop="image" content="' . $actual_link . $blog->photo . '">
        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" content="' . $actual_link . '" />
        <meta property="twitter:title" content="' . $blog->title . '" />
        <meta property="twitter:description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '..." />
        <meta property="twitter:image" content="' . $actual_link . $blog->photo . '" />
        <meta property="twitter:site" content="@Optimaconsult" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="' . $blog->title . '" />
        <meta property="og:description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '..." />
        <meta property="og:image" content="' . $actual_link . $blog->photo . '" />';
        $title_page = $blog->title;

            return view('frontend.pages.reference-details', compact(['blog', 'meta', 'title_page', 'domaine']));
        } else {
            return view('errors.404');
        }
    }

    public function equipe(Request $request)
    {
        $equipe = Team::where(['status' => 'active'])->orderBy('id', 'ASC')->get();

        $header_home = 'equipe';

        return view('frontend.pages.equipe', compact(['equipe', 'header_home']));
    }



    public function productCategory(Request $request, $slug)
    {

        $categories = Category::with('products')->where('slug', $slug)->first();

        if ($categories) {
            $speciality = Brand::where(['status' => 'active'])->orderBy('id', 'DESC')->get();

            $gammes = Gamme::where('child_cat_id',$categories->id)->get();

            if(count($gammes) == 0){
            $products = Product::where(['status' => 'active', 'child_cat_id' => $categories->id])->orderBy('id', 'ASC')->paginate(12);
            }else{
                $products = Product::where(['status' => 'active', 'child_cat_id' => $categories->id])->orderBy('id', 'ASC')->get();
            }


            $route = 'ville';

            if ($request->ajax()) {
                $view = view('frontend.layouts._single-product', compact(['products']))->render();
                return response()->json(['html' => $view]);
            }

            return view('frontend.pages.product.product-category', compact(['categories', 'route', 'products', 'speciality','gammes']));
        } else {
            return view('errors.404');
        }
    }

    // Tous Locaux
    public function tousLocaux(Request $request)
    {


        $speciality = Brand::where(['status' => 'active'])->orderBy('id', 'DESC')->get();

        $villes = Category::where(['status' => 'active', 'is_parent' => 1])->orderBy('id', 'DESC')->get();
        $city = Category::where(['is_parent' => true, 'status' => 'active'])->orderBy('id', 'DESC')->get();


        $sort = '';
        if ($request->sort != null) {
            $sort = $request->sort;
        }

        $price = '';
        if ($request->price_range != null) {
            $price = $request->price_range;
        }
        $surface = '';
        if ($request->surface_range != null) {
            $surface = $request->surface_range;
        }
        $type = '';
        if ($request->search_type != null) {
            $type = $request->search_type;
        }
        $fdc = '';
        if ($request->search_conditions != null) {
            $fdc = $request->search_conditions;
        }

        $products = Product::where(['status' => 'active']);
        if (!empty($price)) {
            $price = explode('-', $price);

            $price[0] = floor($price[0]);
            $price[1] = ceil($price[1]);
            $products = $products->whereBetween('price', $price);
        }
        if (!empty($surface)) {
            $surface = explode('-', $surface);

            $surface[0] = floor($surface[0]);
            $surface[1] = ceil($surface[1]);
            $products = $products->whereBetween('surface', $surface);
        }
        if (!empty($type)) {
            $products = $products->where('conditions', $type);
        }
        if (!empty($fdc)) {
            $products = $products->where('fond', $fdc);
        }
        if (!empty($_GET['search'])) {
            $products = $products->where((function ($query) use ($request) {
                $query->where('title', "like", "%" . $_GET['search'] . "%");
                $query->orWhere('description', "like", "%" . $_GET['search'] . "%");
            }));
        }
        if (!empty($_GET['speciality'])) {
            if (!in_array('', $_GET['speciality'])) {
                $products = $products->whereIn('brand_id', $_GET['speciality']);
            }
        }
        if (!empty($_GET['ville'])) {
            $slug_ville = Category::where('slug', $_GET['ville'])->value('id');
            $products = $products->where('cat_id', $slug_ville);
        }
        if (!empty($_GET['debarquement'])) {
            $slug_ville_d = Category::where('slug', $_GET['debarquement'])->value('id');
            $products = $products->where('child_cat_id', $slug_ville_d);
        }

        if ($sort == 'priceAsc') {

            $products = $products->orderBy('price', 'ASC');

            $products = $products->paginate(12);
        } elseif ($sort == 'priceDesc') {
            $products = $products->orderBy('price', 'DESC');

            $products = $products->paginate(12);
        } elseif ($sort == 'titleAsc') {
            $products = $products->orderBy('title', 'ASC');

            $products = $products->paginate(12);
        } elseif ($sort == 'titleDesc') {
            $products = $products->orderBy('title', 'DESC');

            $products = $products->paginate(12);
        } else {
            $products = $products->orderBy('id', 'DESC');

            $products = $products->paginate(12);
        }


        $route = 'locaux';

        if ($request->ajax()) {
            $view = view('frontend.layouts._single-product', compact(['products']))->render();
            return response()->json(['html' => $view]);
        }

        return view('frontend.pages.product.locaux', compact(['products', 'route', 'speciality', 'villes', 'city']));
    }

    // Tous Locaux à vendre
    public function vendreLocaux(Request $request)
    {


        $speciality = Brand::where(['status' => 'active'])->orderBy('id', 'DESC')->get();

        $villes = Category::where(['status' => 'active', 'is_parent' => 1])->orderBy('id', 'DESC')->get();
        $city = Category::where(['is_parent' => true, 'status' => 'active'])->orderBy('id', 'DESC')->get();


        $sort = '';
        if ($request->sort != null) {
            $sort = $request->sort;
        }

        $price = '';
        if ($request->price_range != null) {
            $price = $request->price_range;
        }
        $surface = '';
        if ($request->surface_range != null) {
            $surface = $request->surface_range;
        }
        $fdc = '';
        if ($request->search_conditions != null) {
            $fdc = $request->search_conditions;
        }

        $products = Product::where(['status' => 'active', 'conditions' => 'sale']);
        if (!empty($price)) {
            $price = explode('-', $price);

            $price[0] = floor($price[0]);
            $price[1] = ceil($price[1]);
            $products = $products->whereBetween('price', $price);
        }
        if (!empty($surface)) {
            $surface = explode('-', $surface);

            $surface[0] = floor($surface[0]);
            $surface[1] = ceil($surface[1]);
            $products = $products->whereBetween('surface', $surface);
        }
        if (!empty($fdc)) {
            $products = $products->where('fond', $fdc);
        }
        if (!empty($_GET['search'])) {
            $products = $products->where((function ($query) use ($request) {
                $query->where('title', "like", "%" . $_GET['search'] . "%");
                $query->orWhere('description', "like", "%" . $_GET['search'] . "%");
            }));
        }
        if (!empty($_GET['speciality'])) {
            if (!in_array('', $_GET['speciality'])) {
                $products = $products->whereIn('brand_id', $_GET['speciality']);
            }
        }
        if (!empty($_GET['ville'])) {
            $slug_ville = Category::where('slug', $_GET['ville'])->value('id');
            $products = $products->where('cat_id', $slug_ville);
        }
        if (!empty($_GET['debarquement'])) {
            $slug_ville_d = Category::where('slug', $_GET['debarquement'])->value('id');
            $products = $products->where('child_cat_id', $slug_ville_d);
        }

        if ($sort == 'priceAsc') {

            $products = $products->orderBy('price', 'ASC');

            $products = $products->paginate(12);
        } elseif ($sort == 'priceDesc') {
            $products = $products->orderBy('price', 'DESC');

            $products = $products->paginate(12);
        } elseif ($sort == 'titleAsc') {
            $products = $products->orderBy('title', 'ASC');

            $products = $products->paginate(12);
        } elseif ($sort == 'titleDesc') {
            $products = $products->orderBy('title', 'DESC');

            $products = $products->paginate(12);
        } else {
            $products = $products->orderBy('id', 'DESC');

            $products = $products->paginate(12);
        }


        $route = 'vendre';

        if ($request->ajax()) {
            $view = view('frontend.layouts._single-product', compact(['products']))->render();
            return response()->json(['html' => $view]);
        }

        return view('frontend.ville.sale', compact(['products', 'route', 'speciality', 'villes', 'city']));
    }

    // Tous Locaux à louer
    public function louerLocaux(Request $request)
    {


        $speciality = Brand::where(['status' => 'active'])->orderBy('id', 'DESC')->get();

        $villes = Category::where(['status' => 'active', 'is_parent' => 1])->orderBy('id', 'DESC')->get();
        $city = Category::where(['is_parent' => true, 'status' => 'active'])->orderBy('id', 'DESC')->get();


        $sort = '';
        if ($request->sort != null) {
            $sort = $request->sort;
        }

        $price = '';
        if ($request->price_range != null) {
            $price = $request->price_range;
        }
        $surface = '';
        if ($request->surface_range != null) {
            $surface = $request->surface_range;
        }
        $fdc = '';
        if ($request->search_conditions != null) {
            $fdc = $request->search_conditions;
        }

        $products = Product::where(['status' => 'active', 'conditions' => 'rent']);
        if (!empty($price)) {
            $price = explode('-', $price);

            $price[0] = floor($price[0]);
            $price[1] = ceil($price[1]);
            $products = $products->whereBetween('price', $price);
        }
        if (!empty($surface)) {
            $surface = explode('-', $surface);

            $surface[0] = floor($surface[0]);
            $surface[1] = ceil($surface[1]);
            $products = $products->whereBetween('surface', $surface);
        }
        if (!empty($fdc)) {
            $products = $products->where('fond', $fdc);
        }
        if (!empty($_GET['search'])) {
            $products = $products->where((function ($query) use ($request) {
                $query->where('title', "like", "%" . $_GET['search'] . "%");
                $query->orWhere('description', "like", "%" . $_GET['search'] . "%");
            }));
        }
        if (!empty($_GET['speciality'])) {
            if (!in_array('', $_GET['speciality'])) {
                $products = $products->whereIn('brand_id', $_GET['speciality']);
            }
        }
        if (!empty($_GET['ville'])) {
            $slug_ville = Category::where('slug', $_GET['ville'])->value('id');
            $products = $products->where('cat_id', $slug_ville);
        }
        if (!empty($_GET['debarquement'])) {
            $slug_ville_d = Category::where('slug', $_GET['debarquement'])->value('id');
            $products = $products->where('child_cat_id', $slug_ville_d);
        }

        if ($sort == 'priceAsc') {

            $products = $products->orderBy('price', 'ASC');

            $products = $products->paginate(12);
        } elseif ($sort == 'priceDesc') {
            $products = $products->orderBy('price', 'DESC');

            $products = $products->paginate(12);
        } elseif ($sort == 'titleAsc') {
            $products = $products->orderBy('title', 'ASC');

            $products = $products->paginate(12);
        } elseif ($sort == 'titleDesc') {
            $products = $products->orderBy('title', 'DESC');

            $products = $products->paginate(12);
        } else {
            $products = $products->orderBy('id', 'DESC');

            $products = $products->paginate(12);
        }


        $route = 'vendre';

        if ($request->ajax()) {
            $view = view('frontend.layouts._single-product', compact(['products']))->render();
            return response()->json(['html' => $view]);
        }

        return view('frontend.ville.sale', compact(['products', 'route', 'speciality', 'villes', 'city']));
    }

    // Blog list
    public function eventList(Request $request)
    {
        $blogs = Blog::where(['status' => 'active','type_blog'=>'event'])->paginate(12);


        $route = 'actualite';

        if ($request->ajax()) {
            $view = view('frontend.layouts._single-blog', compact(['blogs']))->render();
            return response()->json(['html' => $view]);
        }

        return view('frontend.pages.events', compact(['blogs', 'route']));
    }

    // Service Detail
    public function serviceDetail($slug)
    {
        $blog = Service::where('slug', $slug)->first();


        if ($blog) {

        $related_blogs = Service::where(['status'=>'active'])->get();

        $actual_link = 'http://' . $_SERVER["SERVER_NAME"];
        $meta = '<meta itemprop="name" content="' . $blog->title . '">
        <meta itemprop="description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '...">
        <meta itemprop="image" content="' . $actual_link . $blog->photo . '">
        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" content="' . $actual_link . '" />
        <meta property="twitter:title" content="' . $blog->title . '" />
        <meta property="twitter:description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '..." />
        <meta property="twitter:image" content="' . $actual_link . $blog->photo . '" />
        <meta property="twitter:site" content="@HPC" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="' . $blog->title . '" />
        <meta property="og:description" content="' . substr(filter_var($blog->description, FILTER_SANITIZE_STRING), 0, 200) . '..." />
        <meta property="og:image" content="' . $actual_link . $blog->photo . '" />';
        $title_page = $blog->title;


            return view('frontend.pages.service-details', compact(['blog', 'meta', 'title_page','related_blogs']));
        } else {
            return view('errors.404');
        }
    }



    // Demandez un devis

    public function devisSubmit(Request $request)
    {
        $this->validate($request, [
            'nom_local' => 'string|required',
            'name' => 'string|required',
            'email' => 'string|required',
            'phone' => 'string|required',
            'content' => 'string|required',
            'date_d' => 'string|required',
            'time_d' => 'string|required',
        ]);
        $data = $request->all();

        devis::create($data);
        //Modelsdevis::create($data);


        Mail::send('mail/devis', $data, function ($message) use ($data) {
            $message->to(get_setting('email'))
                ->from($data['email'])->subject("Demande de devis de " . $data['name']);
        });

        return back()->with('success', 'Votre devis a été envoyé avec succès');
    }

}
