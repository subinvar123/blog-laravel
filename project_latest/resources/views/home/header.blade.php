<div class="header_main">
   <div class="container-fluid">
      <div class="logo"><a href="index.html"><img src="images/logo.png"></a></div>
      <div class="menu_main">
         <ul>
            @if (Route::has('login'))
            @auth
            <x-app-layout>

               <li class="active"><a href="{{ route('home') }}">Home</a></li>

               <li class="active"><a href="{{ url('/createpost') }}">Create Post</a></li>
               <li>
               <li class="active"><a href="{{ url('/showuserpost') }}">Show Post</a></li>
               <li>
               <li>
                  <x-slot name="header">
            </x-app-layout>
            </li>
            @else
            <li><a href="{{ route('login') }}">Log in</a></li>

            <li><a href="{{ route('register') }}">Register</a></li>
            @endauth
            @endif
         </ul>
      </div>
   </div>
</div>