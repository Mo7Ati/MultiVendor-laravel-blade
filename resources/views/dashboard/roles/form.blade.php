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
         <x-form.input name="name" :value="$role->name" label="name :" />
     </div>
 </div>

 <table class="table">
     <thead>
         <tr>
             <th scope="col">Ability</th>
             <th scope="col">Type</th>
         </tr>
     </thead>

     <tbody>
         @foreach ($abilities as $ability_name => $ability_value)
             <tr>
                 <td> <label for="">{{ $ability_name }} :</label> </td>
                 <td>
                     <label for="" class="form-check-label">Allow</label>
                     <input type="radio" name="abilities[{{ $ability_value }}]" value="allow" id=""
                         @checked($role->hasAbility($ability_value) == 'allow')>
                     <br>
                     <label for="" class="form-check-label">Deny</label>
                     <input type="radio" name="abilities[{{ $ability_value }}]" value="deny" id=""
                         @if (Route::is('dashboard.roles.create')) checked
                           @else
                       @checked($role->hasAbility($ability_value) == 'deny') @endif>
                 </td>
             </tr>
         @endforeach
     </tbody>
 </table>
