<?php
use App\Models\Product;
?>
@extends('Frontend.frontendlayout.frontendmainlayout')
@section('content')
<div id="mainBody">
    <div class="container">
        <hr class="soften">
        <h1>Visit us</h1>
        @include('layouts.adminlayout.adminpartials.alertss')
        <hr class="soften"/>
        <div class="row">
            <div class="span4">
            <h4>Contact Details</h4>
            <p>	18 nyeric,<br/> NY 93727, KENYA
                <br/><br/>
                info@WINRIT.in<br/>
                ﻿Tel 00000-00000<br/>
                Fax 00000-00000<br/>
                web: https://www.youtube.com/PROGRA
            </p>
            </div>


            <div class="span4">
            <h4>Email Us</h4>
            <form class="form-horizontal" method="POST" action="{{ route('contact.us') }}">
                @csrf
            <fieldset>
              <div class="control-group{{$errors->has('name')?' has-error':''}}">

                  <input type="text" name="name" placeholder="name" class="input-xlarge"/>
                  @if ($errors->has('name'))
                  <span class="help-block text-danger" style="color: red">{{$errors->first('name')}}</span>
              @endif
              </div>
               <div class="control-group{{$errors->has('email')?' has-error':''}}">

                  <input type="text" name="email" placeholder="email" class="input-xlarge"/>
                  @if ($errors->has('email'))
                  <span class="help-block text-danger" style="color: red">{{$errors->first('email')}}</span>
              @endif
              </div>
               <div class="control-group{{$errors->has('subject')?' has-error':''}}">

                  <input type="text" name="subject" placeholder="subject" class="input-xlarge"/>
                  @if ($errors->has('subject'))
                  <span class="help-block text-danger" style="color: red">{{$errors->first('subject')}}</span>
              @endif
              </div>
              <div class="control-group{{$errors->has('messsage')?' has-error':''}}">
                  <textarea rows="3" id="textarea" name="messsage" class="input-xlarge"></textarea>
                  @if ($errors->has('messsage'))
                  <span class="help-block text-danger" style="color: red">{{$errors->first('messsage')}}</span>
              @endif
              </div>

                <button class="btn btn-large" type="submit">Send Messages</button>

            </fieldset>
          </form>
            </div>
        </div>
    </div>
    </div>
@endsection
