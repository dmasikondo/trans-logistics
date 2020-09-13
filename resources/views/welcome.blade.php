@extends('layouts.app')
@section('title','Southern Africa based Freight Forwarding and Transport Consultancy Company')
<style>
/* * {
  box-sizing: border-box;
}

html {
  font: 14px/1.4 Sans-Serif;
}

form {
  width: 320px;
  float: left;
  margin: 20px;
}
form > div {
  position: relative;
  overflow: hidden;
}
form input, form textarea {
  width: 100%;
  border: 2px solid gray;
  background: none;
  position: relative;
  top: 0;
  left: 0;
  z-index: 1;
  padding: 8px 12px;
  outline: 0;
}
form input:valid, form textarea:valid {
  background: white;
}
form input:focus, form textarea:focus {
  border-color: #f06d06;
}
form input:focus + label, form textarea:focus + label {
  background: #f06d06;
  color: white;
  font-size: 70%;
  padding: 1px 6px;
  z-index: 2;
  text-transform: uppercase;
}
form label {
  transition: background 0.2s, color 0.2s, top 0.2s, bottom 0.2s, right 0.2s, left 0.2s;
  position: absolute;
  color: #999;
  padding: 7px 6px;
}
form textarea {
  display: block;
  resize: vertical;
}

form.go-bottom input, form.go-bottom textarea {
  padding: 12px 12px 12px 12px;
}
form.go-bottom label {
  top: 0;
  bottom: 0;
  left: 0;
  width: 100%;
}
form.go-bottom input:focus, form.go-bottom textarea:focus {
  padding: 4px 6px 20px 6px;
}
form.go-bottom input:focus + label, form.go-bottom textarea:focus + label {
  top: 100%;
  margin-top: -16px;
}

form.go-right label {
  top: 2px;
  right: 100%;
  width: 100%;
  margin-right: -100%;
  bottom: 2px;
}
form.go-right input:focus + label, form.go-right textarea:focus + label {
  right: 0;
  margin-right: 0;
  width: 40%;
  padding-top: 5px;
}*/
</style>
@section('content')
<form class="go-right">
  <h2>To Bottom</h2>
  <div>
    <input id="name" name="name" type="text" required>
    <label for="name">Your Name</label>
  </div>
  <div>
    <input id="phone" name="phone" type="tel" required>
    <label for="phone">Primary Phone</label>
  </div>
  <div>
    <textarea id="message" name="phone" required></textarea>
    <label for="message">Message</label>
  </div>
</form>


<i class="fa fa-truck">truck</i>
<i class="fa fa-newspaper-o">newspaper</i>
<i class="fa fa-money">money</i>
<i class="fa fa-plane">plane</i>
<i class="fa fa-road">road</i>
<i class="fa fa-rocket">rocket</i>
<i class="fa fa-train">train</i>
<i class="fa fa-spin fa-spinner">spinner</i>
<i class="fa fa-cog">cog</i>
<i class="fa fa-refresh">refresh</i>
<i class="fa fa-spin-circle-o-notch">circle-o-notch</i>
<i class="fa fa-subway">subway</i>

            
@endsection