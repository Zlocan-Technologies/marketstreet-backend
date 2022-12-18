<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-xl-6 xl-100">
        <div class="card">
            <div class="card-body">
            <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-controls="top-home" aria-selected="true">
                        <i class="fa fa-institution"></i>Paystack Credientials
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="false">
                        <i class="fa fa-product-hunt"></i>
                        Cloudinary Credientials</a>
                    </li>
                <li class="nav-item">
                        <a class="nav-link" id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false">
                            <i class="fa fa-cogs"></i>
                            Flutterwave Credientials
                        </a>
                </li>
            </ul>
            <div class="tab-content" id="top-tabContent">
            <div id="messaging" class="messaging d-none p-3 bg-primary text-white">Your Form is currently Processing!</div>

            <!--Paystack Tab-->
                <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                    <div style="max-width: 100%;" class="w-100 container d-flex justify-content-center align-items-center pt-4">
                            <!--Form container-->
                            <div class="mx-auto">
                                <form onsubmit="updatePaystack(event)" id="paystackKeysForm" class="w-100 px-4 py-3">
                                    @csrf
                                    <div class="row w-100">
                                        <div style="position:relative;" class="form-group col-lg-12 col-sm-12 my-4">
                                            <label for="public_key">Public Key<span class="font-danger ml-2">*</span></label>
                                            <input type="text" disabled name="paystack_public_key" value="{{ $keys['paystack_public_key'] }}" id="paystack_public_key" class="form-control">
                                            <i class="fa fa-eye" onclick="reveal('#paystack_public_key', this)" style="position:absolute; right: 10px; top:2px;"></i>
                                            
                                            <!-- <p id="category_name_error" class="hidden error"></p> -->
                                        </div>
                                        <div style="position:relative;" class="form-group col-lg-12 col-sm-12 my-4">
                                            <label for="secret_key">Private Key<span class="font-danger ml-2">*</span></label>
                                            <input type="text" disabled value="{{ $keys['paystack_secret_key'] }}" name="paystack_secret_key" id="paystack_secret_key" class="form-control">
                                            <i class="fa fa-eye" onclick="reveal('#paystack_secret_key', this)"  style="position:absolute; right: 10px; top:2px;"></i>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <button onclick="updatePaystack(event)" id="paystack-btn" class="btn btn-outline-primary form-control">update</button>
                                    </div>
                                </form>
                            </div>
                        </div>



                </div>
            <!--Cloudinary Tab-->
                <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                    <div style="max-width: 100%;" class="w-100 container d-flex justify-content-center align-items-center pt-4">
                            <!--Form container-->
                            <div class="mx-auto">
                                <form onsubmit="updateCloudinary(event)" id="paystackKeysForm" class="w-100 px-4 py-3">
                                    @csrf

                                    <div class="row w-100">
                                        <div style="position:relative;" class="form-group col-lg-12 col-sm-12 my-4">
                                            <label for="cloudinary_api_key">CLOUDINARY_API_KEY<span class="font-danger ml-2">*</span></label>
                                            <input type="text" disabled name="cloudinary_api_key" value="{{ $keys['cloudinary_api_key'] }}" id="cloudinary_api_key" class="form-control">
                                            <i class="fa fa-eye" onclick="reveal('#cloudinary_api_key', this)" style="position:absolute; right: 10px; top:2px;"></i>
                                            
                                            <!-- <p id="category_name_error" class="hidden error"></p> -->
                                        </div>
                                        <div style="position:relative;" class="form-group col-lg-12 col-sm-12 my-4">
                                            <label for="cloudinary_api_secret">CLOUDINARY_API_SECRET<span class="font-danger ml-2">*</span></label>
                                            <input type="text" disabled value="{{ $keys['cloudinary_api_secret'] }}" name="cloudinary_api_secret" id="cloudinary_api_secret" class="form-control">
                                            <i class="fa fa-eye" onclick="reveal('#cloudinary_api_secret', this)"  style="position:absolute; right: 10px; top:2px;"></i>
                                        </div>

                                        <div style="position:relative;" class="form-group col-lg-12 col-sm-12 my-4">
                                            <label for="cloudinary_cloud_name">CLOUDINARY_CLOUD_NAME <span class="font-danger ml-2">*</span></label>
                                            <input type="text" disabled value="{{ $keys['cloudinary_cloud_name'] }}" name="cloudinary_cloud_name" id="cloudinary_cloud_name" class="form-control">
                                            <i class="fa fa-eye" onclick="reveal('#cloudinary_cloud_name', this)"  style="position:absolute; right: 10px; top:2px;"></i>
                                        </div>

                                        <div style="position:relative;" class="form-group col-lg-12 col-sm-12 my-4">
                                            <label for="cloudinary_secure">CLOUDINARY_SECURE<span class="font-danger ml-2">*</span></label>
                                            <select disabled value="{{ $keys['cloudinary_secure'] }}" name="cloudinary_secure" id="cloudinary_secure" class="form-control" disabled >
                                                <option value="{{ $keys['cloudinary_secure'] }}"> {{ $keys['cloudinary_secure'] }}</option>
                                                @if($keys['cloudinary_secure'] == true)
                                                    <option value="false">false</option>
                                                @else
                                                    <option value="true">true</option>
                                                @endif
                                            </select>
                                            <i class="fa fa-eye" onclick="reveal('#cloudinary_secure', this)"  style="position:absolute; right: 10px; top:2px;"></i>
                                        </div>

                                        <div style="position:relative;" class="form-group col-lg-12 col-sm-12 my-4">
                                            <label for="cloudinary_url">CLOUDINARY_URL<span class="font-danger ml-2">*</span></label>
                                            <input type="text" disabled value="{{ $keys['cloudinary_url'] }}" name="cloudinary_url" id="cloudinary_url" class="form-control">
                                            <i class="fa fa-eye" onclick="reveal('#cloudinary_url', this)"  style="position:absolute; right: 10px; top:2px;"></i>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <button onclick="updateCloudinary(event)" id="cloudinary-btn" class="btn btn-outline-primary form-control">update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>

            <!--Flutterwave Tab-->
                <div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                    <div style="max-width: 100%;" class="w-100 container d-flex justify-content-center align-items-center pt-4">
                                <!--Form container-->
                                <div class="mx-auto">
                                    <form onsubmit="updateFlutter(event)" id="paystackKeysForm" class="w-100 px-4 py-3">
                                        @csrf
                                        <div class="row w-100">
                                            <div style="position:relative;" class="form-group col-lg-12 col-sm-12 my-4">
                                                <label for="flw_public_key">FLW_PUBLIC_KEY<span class="font-danger ml-2">*</span></label>
                                                <input type="text" disabled name="flw_public_key" value="{{ $keys['flw_public_key'] }}" id="flw_public_key" class="form-control">
                                                <i class="fa fa-eye" onclick="reveal('#flw_public_key', this)" style="position:absolute; right: 10px; top:2px;"></i>
                                                
                                                <!-- <p id="category_name_error" class="hidden error"></p> -->
                                            </div>

                                            <div style="position:relative;" class="form-group col-lg-12 col-sm-12 my-4">
                                                <label for="flw_secret_key"> FLW_SECRET_KEY <span class="font-danger ml-2">*</span></label>
                                                <input type="text" disabled value="{{ $keys['flw_secret_key'] }}" name="flw_secret_key" id="flw_secret_key" class="form-control">
                                                <i class="fa fa-eye" onclick="reveal('#flw_secret_key', this)"  style="position:absolute; right: 10px; top:2px;"></i>
                                            </div>

                                            <div style="position:relative;" class="form-group col-lg-12 col-sm-12 my-4">
                                                <label for="flw_secret_hash"> FLW_SECRET_HASH <span class="font-danger ml-2">*</span></label>
                                                <input type="text" disabled value="{{ $keys['flw_secret_hash'] }}" name="flw_secret_hash" id="flw_secret_hash" class="form-control">
                                                <i class="fa fa-eye" onclick="reveal('#flw_secret_hash', this)"  style="position:absolute; right: 10px; top:2px;"></i>
                                            </div>

                                            <div style="position:relative;" class="form-group col-lg-12 col-sm-12 my-4">
                                                <label for="flw_encryption_key">FLW_ENCRYPTION_KEY<span class="font-danger ml-2">*</span></label>
                                                <input type="text" disabled value="{{ $keys['flw_encryption_key'] }}" name="flw_encryption_key" id="flw_encryption_key" class="form-control">
                                                <i class="fa fa-eye" onclick="reveal('#flw_encryption_key', this)"  style="position:absolute; right: 10px; top:2px;"></i>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <button onclick="updateFlutter(event)" id="flutter-btn" class="btn btn-outline-primary form-control">update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>



<style>
    #paystackKeysform{
        width: auto;
        max-width: 100%;
    }

    input[type='text'], textarea ,input[type="file"] {
        border-radius: 10px;
    }

    .error {
        color: red;
        font-size: 10px;
        padding: 8px;
    }

</style>