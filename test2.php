<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

<nav class="navbar fixed-top navbar-expand-md navbar-dark bg-dark">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">Navbar</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item" *ngFor="let menuItem of menuItems" routerLinkActive="active">
        <a class="nav-item nav-link" [routerLink]="[menuItem.path]" routerLinkActive="active">{{menuItem.title}}</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <a href="https://www.linkedin.com/"><i class="fa fa-linkedin-square socialIcons" aria-hidden="true"></i></a>
      <a href="https://www.xing.com"><i class="fa fa-xing-square socialIcons" aria-hidden="true"></i></a>
      <a href="https://stackexchange.com/"><i class="fa fa-stack-overflow socialIcons" aria-hidden="true"></i></a>
      <input class="form-control mr-sm-2" type="text" placeholder="Search">
      <button class="btn btn-outline-default my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>