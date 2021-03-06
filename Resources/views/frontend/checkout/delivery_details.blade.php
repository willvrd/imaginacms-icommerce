<div class="card card-block p-3 mb-3">
  <div class="row m-0">
    <div class="rounded-circle bg-primary text-white mr-3 d-flex align-items-center px-3 py-1">
      3
    </div>
    <h3 class="d-flex align-items-center">
      {{ trans('icommerce::delivery_details.title') }}
    </h3>
  </div>
  
  <hr class="my-2"/>
  
  <div class="form-check" v-if="user && user.addresses">
    
    <label class="form-check-label">
      <input type="checkbox"
             class="form-check-input"
             name="sameDeliveryBilling"
             id="sameDeliveryBilling"
             data-toggle="collapse"
             href="#collapseExample"
             aria-expanded="false"
             aria-controls="collapseExample"
             checked
             v-model="sameDeliveryBilling">
      {{ trans('icommerce::delivery_details.same_delivery_billing') }}
    </label>
  </div>
  
  <div class="collapse" id="collapseExample">
    
    <div class="card-block" id="ShippingAddress">
      
      <div class="card mb-0 border-0" v-if="user && user.addresses">
        <div class="card-header bg-white" role="tab" id="useExistingShipping">
          <label class="form-check-label">
            <input
              type="radio"
              class="form-check-input"
              name="existingOrNewShippingAddress"
              id="existingShippingAddress"
              value="1"
              data-parent="#ShippingAddress"
              data-toggle="collapse"
              data-target="#collapseExistingShipping"
              aria-expanded="true"
              aria-controls="collapseExistingShipping"
              v-model="useExistingOrNewShippingAddress"
              checked>
            
            {{trans('icommerce::billing_details.address.old_address')}}
          
          </label>
        </div>
        
        <div id="collapseExistingShipping" :class="useExistingOrNewShippingAddress==1 ? 'collapse in show' : 'collapse'" aria-labelledby="useExistingShipping" role="tabpanel">
          <select :class="'form-control '+ ($v.form.selectedShippingAddress.$error ? 'is-invalid' : '')"
                  id="selectedShippingAddress"
                  v-model="form.selectedShippingAddress">
            <option value="">Selecciona una dirección</option>
            <option v-for="(address, index) in user.addresses" :value="address.id">@{{address.first_name ? address.first_name : address.firstName}} @{{address.last_name ? address.last_name : address.lastName}} - @{{ address.address_1 ? address.address_1 : address.address1 }}</option>
          
          
          </select>
        </div>
        
        <div id="shippingAddressResume" class="card p-2" v-if="shippingAddress" style="font-size: 12px">
          <p class="card-text m-0"><b>{{trans("iprofile::addresses.form.name")}}:</b> @{{shippingAddress.firstName}} @{{ shippingAddress.lastName }}</p>
          <p class="card-text m-0"><b>{{trans("iprofile::addresses.form.phone")}}:</b> @{{shippingAddress.telephone}}</p>
          <p class="card-text m-0"><b>{{trans("iprofile::addresses.form.address")}}:</b> @{{shippingAddress.address1}} @{{ shippingAddress.address2 ?  ", "+shippingAddress.address2 : ""}}</p>
          <p class="card-text m-0"><b>{{trans("iprofile::addresses.form.city")}}:</b> @{{shippingAddress.city}}</p>
          <p class="card-text m-0"><b>{{trans("iprofile::addresses.form.state")}}:</b> @{{shippingAddress.state}}</p>
          <p class="card-text m-0"><b>{{trans("iprofile::addresses.form.country")}}:</b> @{{shippingAddress.country}}</p>
          
          @php
            $addressesExtraFields = is_array(setting('iprofile::userAddressesExtraFields')) ? setting('iprofile::userAddressesExtraFields') : is_array(json_decode(setting('iprofile::userAddressesExtraFields'))) ? json_decode(setting('iprofile::userAddressesExtraFields')) : json_decode(json_encode(setting('iprofile::userAddressesExtraFields')));
          @endphp
          @foreach($addressesExtraFields as $extraField)
            @if($extraField->active)
              <p class="card-text m-0"><b>{{trans("iprofile::addresses.form.$extraField->field")}}:</b> @{{billingAddress[@php echo $extraField->field; @endphp ] || '-'}}</p>
            
            @endif
          @endforeach
          
          <p class="card-text m-0" v-if="shippingAddress.default">
            {{trans("iprofile::addresses.form.default")}}
            <span v-if="shippingAddress.type == 'billing'">({{trans("iprofile::addresses.form.billing")}})</span>
            <span v-if="shippingAddress.type == 'shipping'">({{trans("iprofile::addresses.form.shipping")}})</span>
          </p>
        </div>
      </div>
      
      <div class="card mb-0 border-0">
        <div class="card-header bg-white" role="tab" id="useNewShipping" v-if="addresses">
          <label class="form-check-label">
            <input
              type="radio"
              class="form-check-input collapsed"
              name="existingOrNewShippingAddress"
              id="newShippingAddress"
              value="2"
              data-parent="#ShippingAddress"
              data-toggle="collapse"
              data-target="#collapseNewShipping"
              aria-expanded="true"
              aria-controls="collapseNewShipping"
              v-model="useExistingOrNewShippingAddress">
            
            {{trans('icommerce::delivery_details.address.new_address')}}
          
          </label>
        </div>
        <div id="collapseNewShipping" :class="addresses ? 'collapse' : 'collapse show'" aria-labelledby="useNewShipping" role="tabpanel">
          
          
          <div class="form-group row">
            <div class="col pr-1">
              <label for="shipping_firstname">{{ trans('icommerce::delivery_details.form.first_name') }} </label>
              <input type="text" :class="'form-control '+ ($v.shippingData.firstname.$error ? 'is-invalid' : '')" id="shipping_first_name" name="shipping_firstname"
                     v-model="shippingData.firstname">
            
            </div>
            <div class="col pl-1">
              <label for="shipping_lastname">{{ trans('icommerce::delivery_details.form.last_name') }}</label>
              <input type="text" :class="'form-control '+ ($v.shippingData.lastname.$error ? 'is-invalid' : '')" id="shipping_last_name" name="shipping_lastname"
                     v-model="shippingData.lastname">
            </div>
          
          </div>
          
          <div class="form-group">
            <label for="shipping_address_1">{{ trans('icommerce::delivery_details.form.address1') }}</label>
            <input type="text"  :class="'form-control '+ ($v.shippingData.address_1.$error ? 'is-invalid' : '')" id="shipping_address_1" name="shipping_address_1"
                   v-model="shippingData.address_1">
          </div>
          <div class="form-group">
            <label for="shipping_address_2">{{ trans('icommerce::delivery_details.form.address2') }}</label>
            <input type="text" class="form-control " id="shipping_address_2" name="shipping_address_2"
                   v-model="shippingData.address_2">
          </div>
          
          <div class="form-group">
            <label for="shipping_telephone">{{ trans('icommerce::delivery_details.form.telephone') }}</label>
            <input type="text" :class="'form-control '+ ($v.shippingData.telephone.$error ? 'is-invalid' : '')" id="shipping_telephone" name="shipping_telephone"
                   v-model="shippingData.telephone">
          </div>
          
          <div class="form-group">
            <label for="shipping_country">{{ trans('icommerce::delivery_details.form.country') }}</label>
            <select
              :class="'form-control '+ ($v.shippingData.countryIndex.$error ? 'is-invalid' : '')"
              id="shipping_country"
              name="shipping_country"
              v-model="shippingData.countryIndex"
              v-on:blur="getProvincesByCountry(shippingData.countryIndex, 2)">
              <option value="null">{{ trans('icommerce::delivery_details.form.select_option') }}</option>
              <option v-for="country in countries" v-bind:value="country.iso_2">@{{ country.name }}</option>
            </select>
          
          </div>
          
          
          <div class="form-group">
            <label for="shipping_zone">{{ trans('icommerce::delivery_details.form.state') }}</label>
            <select :class="'form-control '+ ($v.shippingData.zoneIndex.$error ? 'is-invalid' : '')"
                    id="shipping_zone"
                    name="shipping_zone"
                    v-model="shippingData.zoneIndex"
                    v-show="!statesShippingAlternative">
              <option v-for="state in statesDelivery" v-bind:value="state.iso_2">@{{ state.name }}</option>
              <option value="null">{{ trans('icommerce::delivery_details.form.select_country') }}</option>
            </select>
          
          </div>
          
          
          <div class="form-group">
            
            <label for="shipping_city">{{ trans('icommerce::delivery_details.form.city') }}</label>
            <input type="text" :class="'form-control '+ ($v.shippingData.city.$error ? 'is-invalid' : '')" name="shipping_city" id="shipping_city"
                   v-model="shippingData.city">
          </div>
          
          
          <!--17-09-2020::JCEC - primera version del address extra fields
                                        toca irlo mejorando-->
          @php
            $registerExtraFields = is_array(setting('iprofile::registerExtraFields')) ? setting('iprofile::registerExtraFields') : is_array(json_decode(setting('iprofile::registerExtraFields'))) ? json_decode(setting('iprofile::registerExtraFields')) : json_decode(json_encode(setting('iprofile::registerExtraFields')));
          @endphp
          @foreach($addressesExtraFields as $extraField)
            @if($extraField->active)
              <div class="form-group ">
                <label for="{{$extraField->field}}">{{trans("iprofile::frontend.form.$extraField->field")}}</label>
                <input id="delivery{{$extraField->field}}"
                       type="text"
                       class="form-control"
                       v-model="shippingData.options.{{$extraField->field}}">
              
              </div>
            @endif
          @endforeach
          
          <div class="form-check" >
            
            <label class="form-check-label">
              <input type="checkbox"
                     class="form-check-input"
                     v-model="shippingData.default">
              {{ trans('iprofile::frontend.form.defaultShipping') }}
            </label>
          </div>
          
          <div class="form-group text-center">
            <button type="button" class="btn btn-primary" @click="addAddress('shipping')" name="button">Agregar dirección</button>
          </div>
        </div>
      
      
      </div>
    
    
    </div>
  </div>
</div>
