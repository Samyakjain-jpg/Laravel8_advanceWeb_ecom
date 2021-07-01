@extends('admin.layout.layout')

@section('content')

<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Form Design <small>different form elements</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form id="demo-form2" method="post" action="{{route('product.extraDetailsStore',$id)}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
                    @csrf

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Details<span class="required">*</span>
                        </label>
                      </div>             
                      <div class="form-group  ">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ttile<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" value="{{@$product->productdetail->title}}" required="required" name="title" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Total Items<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" value="{{@$product->productdetail->total_item}}" required="required" name="total_item" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>                   
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Discription<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea required="required" name="description" rows="5" class="form-control col-md-7 col-xs-12">{{@$product->productdetail->description}}</textarea>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <input type="submit" class="submit" class="btn btn-success" value="Submit">
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>



@endsection