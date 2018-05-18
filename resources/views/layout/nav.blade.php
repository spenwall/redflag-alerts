<nav class="navbar is-primary">
  <div class="navbar-brand">
    <a class="navbar-item" href="/">
      Redflag Deal Alerts
    </a>
    <div class="navbar-burger burger" :class="{ 'is-active': showBurger }" data-target="nav-menu" @click="showBurger = !showBurger">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>


  <div id="nav-menu" class="navbar-menu" :class="{ 'is-active': showBurger }">
    
    <div class="navbar-end">
    @guest  
    <div class="navbar-item">
        <div class="field is-grouped">
          <p class="control">
            <a class="button is-info" href="{{ route('login') }}">
              <span class="icon">
                <i class="fas fa-sign-in-alt"></i>
              </span>
              <span>
              {{ __('Login') }}
              </span>
            </a>
          </p>
          <p class="control">
            <a class="button is-link" href="{{ route('register') }}">
              <span>
                  {{ __('Register') }}
              </span>
            </a>
          </p>
        </div>
      </div>
    </div>
    @else
    <div class="navbar-item">
    <div class="field is-grouped">
          <p class="control">
            <a class="button is-info" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
              <span class="icon">
                <i class="fas fa-sign-out-alt"></i>
              </span>
              <span>
              {{ __('Logout') }}
              </span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
          </p>
    </div>
    @endguest
  </div>
</nav>