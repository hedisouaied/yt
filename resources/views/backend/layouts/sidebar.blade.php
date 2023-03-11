<div class="main-menu">
	<header class="header">
		<a href="{{route('admin')}}" class="logo">MS Para</a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
	</header>

	<div class="content">
		<div class="navigation">
			<ul class="menu js__accordion">
				<li class="current">
					<a class="waves-effect" href="{{route('admin')}}"><i class="menu-icon mdi mdi-view-dashboard"></i><span>Tableau de bord</span></a>
				</li>

                <li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-user"></i><span>Gestion des admins </span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{route('user.index')}}">Tous admins</a></li>
						<li><a href="{{route('user.create')}}">Ajouter admin</a></li>
					</ul>
				</li>

                <li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-image"></i><span>Gestion des bannières </span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{route('banner.index')}}">Tous bannières</a></li>
						<li><a href="{{route('banner.create')}}">Ajouter bannière</a></li>
					</ul>
				</li>

                <li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-tag"></i><span>Gestion des coupons </span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{route('coupon.index')}}">Tous coupons</a></li>
						<li><a href="{{route('coupon.create')}}">Ajouter coupon</a></li>
					</ul>
				</li>

				<li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-usd"></i><span>Liste des commandes </span><span class="notice notice-danger">{{\App\Models\Checkout::count()}}</span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{route('devis.index')}}">Tous Commandes (<span class="text-danger">{{\App\Models\Checkout::count()}}</span>) </a>  </li>

						<li><a href="{{route('devis.jour')}}">Tous Commandes d'aujourd'hui (<span class="text-danger">{{\App\Models\Checkout::whereDate('created_at', '=', date('Y-m-d'))->count()}}</span>) </a>  </li>

						<li><a href="{{route('devis.encours')}}">Tous Commandes en cours de traitement (<span class="text-danger">{{\App\Models\Checkout::where('etat', 'encours')->count()}}</span>) </a>  </li>
						<li><a href="{{route('devis.accepte')}}">Tous Commandes acceptées (<span class="text-danger">{{\App\Models\Checkout::where('etat', 'accepte')->count()}}</span>) </a>  </li>
						<li><a href="{{route('devis.delivred')}}">Tous Commandes delivrées (<span class="text-danger">{{\App\Models\Checkout::where('etat', 'delivred')->count()}}</span>) </a>  </li>
						<li><a href="{{route('devis.refuse')}}">Tous Commandes réfusées (<span class="text-danger">{{\App\Models\Checkout::where('etat', 'refuse')->count()}}</span>) </a>  </li>

					</ul>
				</li>

                <li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-bolt"></i><span>Gestion des ventes flash</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{route('vente-flash.index')}}">Tous ventes flash</a></li>

						<li><a href="{{route('vente-flash.create')}}">Ajouter vente flash</a></li>
					</ul>
				</li>

                <li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-shopping-cart"></i><span>Gestion des produits</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{route('product.index')}}">Tous produits</a></li>
						<li><a href="{{route('product.in.stock')}}">Tous produits in_stock (<span class="text-success">{{\App\Models\Product::where('stock','!=',0)->count()}}</span>)</a></li>
						<li><a href="{{route('product.out.stock')}}">Tous produits out_stock (<span class="text-danger">{{\App\Models\Product::where('stock',0)->count()}}</span>)</a></li>
						<li><a href="{{route('product.create')}}">Ajouter produit</a></li>
					</ul>
				</li>

                <li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-asterisk"  style="font-size: 40px;" ></i><span>Grands catégories </span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{route('grand-category.index')}}">Tous grands catégories</a></li>
						<li><a href="{{route('grand-category.create')}}">Ajouter grand catégorie</a></li>
					</ul>
				</li>


                <li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-asterisk" style="font-size: 30px;" ></i><span>Sous catégories </span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{route('category.index')}}">Tous sous catégories</a></li>
						<li><a href="{{route('category.create')}}">Ajouter sous catégorie</a></li>
					</ul>
				</li>


                <li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fa fa-asterisk " style="font-size: 20px;"></i><span>Sous sous-catégories </span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{route('souscategory.index')}}">Tous sous sous-catégories</a></li>
						<li><a href="{{route('souscategory.create')}}">Ajouter sous sous-catégories</a></li>
					</ul>
				</li>
                <li>
					<a class="waves-effect" href="{{route('clients.index')}}"><i class="menu-icon fa fa-users "></i><span>Nos Clients</span><span class="notice notice-danger" style="background: rgb(207, 197, 106);">{{\App\Models\User::where('role','seller')->count()}}</span></a>
				</li>
                <li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon mdi mdi-newspaper"></i><span>Gestion d'articles</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{route('actualite.index')}}">Tous articles</a></li>
						<li><a href="{{route('actualite.create')}}">Ajouter article</a></li>
					</ul>
				</li>
                <li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fas fa-award"></i><span>Gestion des marques</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{route('partenaire.index')}}">Tous nos marques</a></li>
						<li><a href="{{route('partenaire.create')}}">Ajouter marque</a></li>
					</ul>
				</li>
                <li>
					<a class="waves-effect parent-item js__control" href="#"><i class="menu-icon fas fa-bullhorn"></i><span>Gestion des témoignages</span><span class="menu-arrow fa fa-angle-down"></span></a>
					<ul class="sub-menu js__content">
						<li><a href="{{route('feedback.index')}}">Tous témoignages</a></li>
						<li><a href="{{route('feedback.create')}}">Ajouter témoignage</a></li>
					</ul>
				</li>

                <li>
					<a class="waves-effect" href="{{route('about.index')}}"><i class="menu-icon mdi mdi-settings"></i><span>à propos</span></a>
                </li>


                <li>
					<a class="waves-effect" href="{{route('contacts.index')}}"><i class="menu-icon fa fa-envelope"></i><span>Messages</span><span class="notice notice-danger" style="background: rgb(79, 96, 248);" >{{\App\Models\Contact::count()}}</span></a>
                </li>

                <li>
					<a class="waves-effect" href="{{route('newsletter.index')}}"><i class="menu-icon fa fa-newspaper-o"></i><span>NewsLetter</span><span class="notice notice-danger" style="background: rgb(37, 37, 37);">{{\App\Models\NewsLetter::count()}}</span></a>
                </li>



			</ul>
		</div>
	</div>
</div>
