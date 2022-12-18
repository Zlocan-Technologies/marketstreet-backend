<?php

return [
    'paystack_public_key'   =>      env('PAYSTACK_PUBLIC'),
    'paystack_secret_key'   =>      env('PAYSTACK_SECRET'),
    'cloudinary_api_key'    =>      env('CLOUDINARY_API_KEY'),
    'cloudinary_api_secret' =>      env('CLOUDINARY_API_SECRET'),
    'cloudinary_cloud_name' =>      env('CLOUDINARY_CLOUD_NAME'),
    'cloudinary_secure'     =>      env('CLOUDINARY_SECURE') == true ? 'true': 'false',
    'cloudinary_url'        =>      env('CLOUDINARY_URL'),
    'flw_secret_key'        =>      env('FLW_SECRET_KEY'),
    'flw_public_key'        =>      env('FLW_PUBLIC_KEY'),
    'flw_secret_hash'       =>      env('FLW_SECRET_HASH'),
    'flw_encryption_key'    =>      env('FLW_ENCRYPTION_KEY')
];