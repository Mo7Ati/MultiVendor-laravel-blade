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
     <x-form.input name="name" :value="$product->name" label="name :" />
 </div>

 <div class="row col">
     <div class="col-6">
         <x-form.select :options="$categories" first-value="" first-item="Primary Category" name="category_id" label="category"
             :selected="$product->category_id" />
     </div>
     <div class="col-6">
         <x-form.select :options="$stores" first-value="" first-item="" name="store_id" label="Store"
             :selected="$product->store_id" />
     </div>
 </div>

 <div class="row col">
     <div class="col-6">
         <label class="form-group "> Description :</label>
         <textarea name="description" cols="30" class="form-control ">
                 {{ old('description', $product->description) }}
     </textarea>
     </div>

     <div class="col-6">
         <x-form.input label="tags :" name="tags"
             value="{{ implode(',', $product->tags()->orderBy('id')->pluck('name')->toArray()) }}" />
     </div>
 </div>



 <br>
 <div class="row col">
     <div class="col-6">
         <x-form.input name="price" :value="$product->price" label="price :" />
     </div>
     <div class="col-6">
         <x-form.input name="compare_price" :value="$product->compare_price" label="compare_price :" />
     </div>
 </div>



 <div class="col-5">
     <label class="form-group"> Status : </label>

     <div class="form-check">
         <input class="form-check-input" type="radio" name="status" id="flexRadioDefault1" value="active"
             @if (Route::is('dashboard.products.create')) checked @endif @checked(old('status', $product->status) == 'active')>
         <label class="form-check-label" for="flexRadioDefault1">
             Active
         </label>
     </div>

     <div class="form-check">
         <input class="form-check-input" type="radio" name="status" id="flexRadioDefault2" value="archived"
             @checked(old('status', $product->status) == 'archived')>
         <label class="form-check-label" for="flexRadioDefault2">
             Archived
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
     <label class="input-group-text" for="inputGroupFile01">Image</label>
     <input type="file" class="form-control" id="inputGroupFile01" name="image">
 </div>
