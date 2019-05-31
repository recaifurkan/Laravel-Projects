@php

    $url = Request::url();
    $siteName = "recenthub.com";
    if(!isset($title)){
        $title = "recenthub.com";

    }
@endphp
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<div id="socialSharing">
    <a href="http://www.facebook.com/sharer.php?u={{$url}}">
        <span id="facebook" class="fa-stack fa-lg">
            <i class="fa fa-facebook fa-stack-1x"></i>
        </span>
    </a>
    <a href="http://twitter.com/share?text={!!$title!!}&url={{$url}}">
        <span id="twitter" class="fa-stack fa-lg">
            <i class="fa fa-twitter fa-stack-1x"></i>
        </span>
    </a>
    
    <a href="https://plus.google.com/share?url={{$url}}">
        <span id="googleplus" class="fa-stack fa-lg">
            <i class="fa fa-google-plus fa-stack-1x"></i>
        </span>
    </a>
    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{$url}}&title={!!$title!!}&source={{$siteName}}">
        <span id="linkedin" class="fa-stack fa-lg">
            <i class="fa fa-linkedin fa-stack-1x"></i>
        </span>
    </a>
    <a href="whatsapp://send?&text={!!$title!!} {{$url}}" data-action="share/whatsapp/share">
        <span id="whatsapp" class="fa-stack fa-lg">
            <i class="fa fa-whatsapp fa-stack-1x"></i> 
        </span>
    </a>
</div>

<style>
div#socialSharing a span.fa-lg {
    border-radius: 50%;
    margin: 1%;
    color: #FFFFFF;
}
 
div#socialSharing a span.fa-lg i {
    font-style: normal;
}
 
div#socialSharing a span#facebook {
    background-color: #3b5998;
}
 
div#socialSharing a span#facebook:hover {
    background-color: #133783;
}
 
div#socialSharing a span#twitter {
    background-color: #1da1f2;
}
 
div#socialSharing a span#twitter:hover {
    background-color: #2582bb;
}
 

 
div#socialSharing a span#googleplus {
    background-color: #db4437;
}
 
div#socialSharing a span#googleplus:hover {
    background-color: #cf1808;
}
 
div#socialSharing a span#linkedin {
    background-color: #0077b5;
}
 
div#socialSharing a span#linkedin:hover {
    background-color: #02689d;
}
 
div#socialSharing a span#whatsapp {
    background-color: #00E676;
}
 
div#socialSharing a span#whatsapp:hover {
    background-color: #03c164;
}


</style>