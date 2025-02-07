 @if ($errors->any())
     <div class="alert alert-danger">
         <h5>Errors : </h5>
         <ul>
             @foreach ($errors->all() as $error)
                 <li> {{ $error }} </li>
             @endforeach
         </ul>
     </div>
 @endif

 <div class="row col">
     <div class="col-6">
         <x-form.input name="name" :value="$user->name" label="name :" />
     </div>

     <div class="col-6">
         <x-form.input name="email" :value="$user->email" label="Email :" />
     </div>
 </div>

 <div class="col-6">
     <x-form.input name="password" :value="$user->password" label="Password :" />
 </div>




