<!-- HTML CSS javascript Header --> 

  <header class="header">
    <nav class="nav">
      <div class="nav__data">
          <a href="/" class="nav__logo">
          <img id="logo-img" src="{{ asset('web/logo/ppc-logo-blue.png') }}" alt=""​><div class="bsea-title" style="font-size: 1.2rem"><h4> ព្រះវិហារសភាភិបាលពោធិ៍ចិនតុង</h4> Pochentong Presbyterian Church</div>
          </a>
          
          <div class="nav__toggle" id="nav-toggle">
            <i class="ri-menu-line nav__burger"></i>
            <i class="ri-close-line nav__close"></i>
          </div>
      </div>

      <!--=============== NAV MENU ===============-->
      <div class="nav__menu" id="nav-menu">
          <ul class="nav__list">
            <li><a href="/" class="nav__link">Home</a></li>


            <!--=============== DROPDOWN 1 ===============-->
            <li class="dropdown__item">
                <div class="nav__link">
                  News <i class="ri-arrow-down-s-line dropdown__arrow"></i>
                </div>

                <ul class="dropdown__menu">
                  <li>
                      <a href="#" class="dropdown__link">
                        <i class="ri-price-tag-3-line"></i> Tags
                      </a>                          
                  </li>

                  <li>
                      <a href="#" class="dropdown__link">
                        <i class="ri-file-list-line"></i> Categories
                      </a>
                  </li>
                </ul>
            </li>

            <li><a href="#" class="nav__link">Members</a></li>
            
            <li><a href="#" class="nav__link">Download</a></li>
            
            @if(Auth::check())
            <li class="dropdown__item">
              <div class="nav__link">
                Transaction <i class="ri-arrow-down-s-line dropdown__arrow"></i>
              </div>
              <ul class="dropdown__menu">
                <li>
                  <li>
                    <a class="dropdown__link" href="{{ route('detailIncome') }}" title="Income"><i class="ri-arrow-down-circle-line"></i> Income</a>
                  </li>
                  <li>
                    <a class="dropdown__link" href="{{ route('detailExpense') }}" title="Expense"><i class="ri-arrow-up-circle-line"></i> Expense</a>
                  </li>
                </li>
              </ul>
            </li>
            @endif
            <!--=============== DROPDOWN 2 ===============-->
            @if(Auth::check())
            <li class="dropdown__item">
              <div class="nav__link">
                {{ Auth::user()->name }} <i class="ri-arrow-down-s-line dropdown__arrow"></i>
              </div>
              <ul class="dropdown__menu">
                <li>
                  <li>
                    <a class="dropdown__link" href="{{ route('dashboard') }}" title="Dashboard"><i class="ri-dashboard-3-line"></i> Dashboard</a>
                  </li>
                  <li>
                    <a class="dropdown__link" title="Logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ri-logout-box-line"></i> Logout</a>
                  </li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </li>
              </ul>
            </li>
            @else
            <li><a href="{{ route('login') }}" class="nav__link"><i class="ri-user-line"></i> Login</a></li>
            @endif
          </ul>
      </div>
    </nav>
  </header>

  <!-- <i class="ri-dashboard-3-line"></i> -->