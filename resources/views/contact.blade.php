@extends('layouts.app')
@section('title','Home')
@section('content')
<div class="breadcrumbs-wrap with-bg-img" data-bg="{{asset('frontend')}}/images/about/1920x266_bg1.jpg" style="background-image: url(&quot;{{asset('frontend')}}/images/about/1920x266_bg1.jpg&quot;);">
    <div class="container">
        <h1 class="page-title">
            Contact Us
        </h1>
    </div>
</div>
<div id="content">
    <div class="page-section">
        <div class="container wide">
            <div class="our-info style-2 item-col-3">
                <div class="info-item">
                    <span class="licon-phone-wave"></span>
                    <span class="info-title">96560909902</span>
                    <span>Mobile</span>
                </div>
                <div class="info-item">
                </div>
                <div class="info-item">
                    <span class="licon-at-sign"></span>
                    <span class="info-title">info@alfaisalkw.com</span>
                    <span>Email</span>
                </div>
            </div>
        </div>
    </div>
    <div class="page-section send_section">
        <div class="overlay"></div>
        <div class="container wide ">
            <div class="row justify-content-center col-no-space">
                <div class="col-xl-6 col-lg-8">
                    <div class="rsvp-form no-bg">
                        <div class="form-header">
                            <h2 class="title">We'd Love To Hear From You</h2>
                            <p>Feel free to send us any questions you may have. We are happy to answer them</p>
                        </div>
                        <form class="contact-form" action="//contactus/send" method="post">
                            <input type="hidden" name="_token" value="053ttrZWWkydulzwvwpewOyg3GZ8i0A08BZrW8hU">
                            <div class="input-box">
                                <input type="text" name="name" required="">
                                <label>Name</label>
                            </div>
                            <div class="input-box">
                                <input type="email" name="email" required="">
                                <label>Email</label>
                            </div>
                            <div class="input-box">
                                <input type="text" name="subject" required="">
                                <label>Subject</label>
                            </div>
                            <div class="input-box">
                                <input type="text" name="message" required="">
                                <label>Message</label>
                            </div>
                            <div class="input-box align-center">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
