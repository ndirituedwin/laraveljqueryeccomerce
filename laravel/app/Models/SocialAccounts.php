<?php

namespace App\Models;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Socialite\Facades\Socialite;

// class SocialAccounts extends Model
// {
//     use HasFactory;
// }
class SocialAccounts {
      public function findOrCreate(ProviderUser $providerUser){
        $account=Socialite::where('provider','google')->where('provider_user_id',$providerUser->getId())->first();
           if($account){
               return $account->user;
           }  else{
               $account=new SocialAccounts([

                'provider_user_id'=>$providerUser->getId(),
                 'provider'=>'google'
               ]);
               $user=User::whereEmail($providerUser->getEmail())->first();
               if(!$user){
                   $user=User::create([
                       'first_name'=>$providerUser->getName(),
                       'last_name'=>$providerUser->getName(),
                       'email'=>$providerUser->getEmail(),

                   ]);

               }
               $account->user()->associate($user);
               $account->save();
           }
    }
}
