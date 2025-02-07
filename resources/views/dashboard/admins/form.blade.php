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
         <x-form.input name="name" :value="$admin->name" label="name :" />
     </div>

     <div class="col-6">
         <x-form.input name="username" :value="$admin->username" label="User Name :" />
     </div>
 </div>

 <div class="row col">
     <div class="col-6">
         <x-form.input name="email" :value="$admin->email" label="Email :" />
     </div>

     <div class="col-6">
         <x-form.input name="phone_number" :value="$admin->phone_number" label="Phone Number :" />
     </div>
 </div>

 <div class="col-6">
     <x-form.input name="password" :value="$admin->password" label="Password :" />
 </div>

 <div class="row col">

     <div class="col-6">
         <label>Status : </label>
         <div class="form-check">
             <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="active"
                 @if (Route::is('dashboard.admins.create')) checked @endif @checked(old('status', $admin->status) == 'active')>
             <label class="form-check-label" for="flexRadioDefault1">
                 Active
             </label>
         </div>

         <div class="form-check">
             <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="inactive"
                 @checked(old('status', $admin->status) == 'inactive')>
             <label class="form-check-label" for="flexRadioDefault2">
                 InActive
             </label>
         </div>
     </div>
     <div class="row col">
         <label>Super Admin : </label>
         <br>
         <div class="form-check">
             <input class="form-check-input" type="radio" name="super_admin" id="flexRadioDefault1" value="1"
                 @if (Route::is('dashboard.admins.create')) checked @endif @checked(old('super_admin', $admin->super_admin) == 'true')>
             <label class="form-check-label" for="flexRadioDefault1">
                 True
             </label>
         </div>

         <div class="form-check">
             <input class="form-check-input" type="radio" name="super_admin" id="flexRadioDefault2" value="0"
                 @checked(old('super_admin', $admin->super_admin) == 'false')>
             <label class="form-check-label" for="flexRadioDefault2">
                 False
             </label>
         </div>
     </div>
 </div>
