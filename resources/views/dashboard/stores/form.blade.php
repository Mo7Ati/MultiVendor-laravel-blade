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

 <div class="col-5">
     <x-form.input name="name" :value="$store->name" label="name :" />
 </div>

 <div class="col-5">
     <label class="form-group"> Description :</label>
     <textarea name="description" cols="30" class="form-control">
            {{ old('description', $store->description) }}
    </textarea>
 </div>

 <div class="col-5">
     <label>Status : </label>
     <div class="form-check">
         <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="active"
             @if (Route::is('dashboard.stores.create')) checked @endif @checked(old('status', $store->status) == 'active')>
         <label class="form-check-label" for="flexRadioDefault1">
             Active
         </label>
     </div>

     <div class="form-check">
         <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="inactive"
             @checked(old('status', $store->status) == 'inactive')>
         <label class="form-check-label" for="flexRadioDefault2">
             InActive
         </label>
     </div>
 </div>
 @error('status')
     <div class="alert-danger">
         {{ $message }}
     </div>
 @enderror
 <br>

 <div class="input-group mb-3">
     <label class="input-group-text" for="inputGroupFile01">Logo</label>
     <input type="file" class="form-control" id="inputGroupFile01" name="logo_image">
 </div>
