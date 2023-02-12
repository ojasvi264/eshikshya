@extends('layouts.base_temp')

@section('content')

<style type="text/css">
    .noarrow,.accordion-button:not(.collapsed)::after,.accordion-button::after{
        background-image:none !important;
    }
    .accordion-button:not(.collapsed){
        background-color: transparent;
        color: #000;
        box-shadow: none;
    }
    .accordion-item{
        border: none;
    }

    .arrow{
        background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%230c63e4'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e);
    }
    .item-name{
        margin-bottom: 0;
        margin-left: 13px;
    }
    .margin-lt{
        margin-left: 35px;
    }
    .tab-content{
        border: 1px solid #359fd2 ;
    }
    .mg-all{
        padding:20px;
    }

    .nav-link.active{
        color: #fff !important;
    background-color: #359fd2 !important;
    }
    .nav-tabs .nav-link{
        border: 1px solid #359fd2 !important;
    }
    .moveright{
        right: 0;
        position: absolute;
    }
</style> 
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    @include('includes.dashboard.message')
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach($category['Data'] as $key => $value)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php if($key==0){ echo 'active'; } ?>"  data-bs-toggle="tab" data-bs-target="#{{$value['Name']}}" type="button" role="tab" aria-controls="{{$value['Name']}}" aria-selected="true">{{$value['Name']}}</button>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        
                            @foreach($category['Data'] as $key => $value)
                            <div class="tab-pane mg-all fade <?php if($key==0){ echo 'active show'; } ?>" id="{{$value['Name']}}" role="tabpanel" aria-labelledby="{{$value['Name']}}">
                                

                                <?php 
                                $accountdata = new App\Models\AccountCategory();
                                $subchild = $accountdata->getsubsidiary($value['GLCode']);
                                ?>
                                <form method="post" action="{{ route('account.category.store') }}"> 
                                    @csrf
                                <div class="form-group">
                                    <label class="form-label">Choose parent Category</label>
                                    <span style="color: red;font-size: 25px">*</span>
                                    @foreach($subchild['Data'] as $key => $subchilds)
                                        <div class="accordion" id="{{$subchilds['Name']}}">
                                            <div class="accordion-item">
                                                <h2 id="headingOne">
                                                  <div class="accordion-button <?php if($key!==0){ echo 'collapsed'; } ?> <?php if($subchilds['IsGlSubSidiary']==false){ echo 'arrow'; }else{ echo 'noarrow'; } ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">&nbsp;
                                                    <input type="checkbox" class="radio" name="GLCode" value="{{$subchilds['GLCode']}}"><label class="item-name">{{$subchilds['Name']}}</label>

                                                    <a href="" class="btn btn-warning pull-right moveright" data-toggle="modal" data-target="#editModal" title="Edit" data-id="<?php echo $subchilds['GLCode']; ?>" data-name="<?php echo $subchilds["Name"]; ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>

                                                  </div>
                                                </h2>
                                                <div id="collapse{{$key}}" class="accordion-collapse collapse margin-lt" aria-labelledby="headingOne" data-bs-parent="#{{$subchilds['Name']}}">
                                                    <?php 
                                                        $subchild2 = $accountdata->getsubsidiary($subchilds['GLCode']);
                                                        
                                                        ?>

                                                        @foreach($subchild2['Data'] as $key => $value2)
                                                    <?php if($value2['IsGlSubSidiary']==false) : ?>
                                                        <div class="accordion-button <?php if($key!==0){ echo 'collapsed'; } ?> <?php if($value2['IsGlSubSidiary']==false){ echo 'arrow'; }else{ echo 'noarrow'; } ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapsetwo{{$key}}" aria-expanded="true" aria-controls=".accordion-button::after{{$key}}">
                                                        <input type="checkbox" name="GLCode"  id="parent-<?php echo $value2["Id"]; ?>" value="<?php echo $value2['GLCode']; ?>" class="toggle-accordion radio">
                                                            <label class="item-name">{{$value2['Name']}}</label>
                                                            <a href="" class="btn btn-warning pull-right moveright" data-toggle="modal" data-target="#editModal" title="Edit" data-id="<?php echo $value2['GLCode']; ?>" data-name="<?php echo $value2["Name"]; ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        </div>
                                                        <div id="collapsetwo{{$key}}" class="accordion-collapse collapse margin-lt" aria-labelledby="headingOne" data-bs-parent="#{{$subchilds['Name']}}">
                                                            <?php 
                                                                $subchild3 = $accountdata->getsubsidiary($value2['GLCode']);
                                                                
                                                                ?>

                                                                @foreach($subchild3['Data'] as $key => $value3)
                                                            <?php if($value3['IsGlSubSidiary']==false) : ?>
                                                                <div class="accordion-button <?php if($key!==0){ echo 'collapsed'; } ?> <?php if($value3['IsGlSubSidiary']==false){ echo 'arrow'; }else{ echo 'noarrow'; } ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapsethree{{$key}}" aria-expanded="true" aria-controls=".accordion-button::after{{$key}}">
                                                                <input type="checkbox" name="GLCode"  id="parent-<?php echo $value3["Id"]; ?>" value="<?php echo $value3['GLCode']; ?>" class="toggle-accordion radio">
                                                                    <label class="item-name">{{$value3['Name']}}</label>

                                                                    <a href="" class="btn btn-warning pull-right moveright" data-toggle="modal" data-target="#editModal" title="Edit" data-id="<?php echo $value3['GLCode']; ?>" data-name="<?php echo $value3["Name"]; ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>

                                                                </div>
                                                            <?php else : ?>
                                                                <div class="accordion-button">
                                                                <i class="fa fa-arrow-right"></i>
                                                                <label class="item-name">{{$value3['Name']}}</label>
                                                                <a href="" class="btn btn-warning pull-right moveright" data-toggle="modal" data-target="#editModal" title="Edit" data-id="<?php echo $value3['GLCode']; ?>" data-name="<?php echo $value3["Name"]; ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                                <br>
                                                            </div>
                                                            <?php endif; ?>
                                                          @endforeach
                                                        </div>
                                                    <?php else : ?>
                                                        <div class="accordion-button">
                                                        <i class="fa fa-arrow-right"></i>
                                                        <label class="item-name">{{$value2['Name']}}</label>
                                                        <a href="" class="btn btn-warning pull-right moveright" data-toggle="modal" data-target="#editModal" title="Edit" data-id="<?php echo $value2['GLCode']; ?>" data-name="<?php echo $value2["Name"]; ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <br>
                                                    </div>
                                                    <?php endif; ?>
                                                  @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Title</label>
                                    <span style="color: red;font-size: 25px">*</span>
                                    <input type="text" name="title" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Type</label>
                                    <span style="color: red;font-size: 25px">*</span>
                                    <select name="category_type"class="form-control">
                                        <option>--Select--</option>
                                        <option value="group">Group</option>
                                        <option value="final">Final Ledger</option>
                                    </select>
                                    <input type="hidden" name="trans_id" value="<?php $guid= new App\Models\AccountCategory(); echo $guid->GUID(); ?>">
                                </div>
                                <input type="submit" class="btn btn-success" value="Submit">
                        </form>
                            </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" role="dialog" aria-hidden="false">
        <div class="modal-dialog">
            <form action="{{ route('account.category.update') }}" method="post">
                @csrf
        <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title">Edit Ledger Name</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
                
            </div>
            <div class="modal-body">
                <input type="hidden" name="glcode" id="glcode">
                <label>Name</label>
                <span style="color: red;font-size: 25px">*</span><br>
                <input type="text" name="glname" class="form-control" id="glname">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary pull-right payment_collect">Edit</button>
                <button  type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
            
        </div>
        </form>
    </div>
    </div>

    <script type="text/javascript">
        $("#editModal").on('shown.bs.modal', function (e) {
            e.stopPropagation();
            var data = $(e.relatedTarget).data();
            var modal = $(this);
            var glcode = data.id;
            var glname = data.name;
            $('#glcode').val(glcode); 
            $('#glname').val(glname);       
        });
    </script>

<script>
$("input:checkbox").on('click', function() {
    var $box = $(this);
    if ($box.is(":checked")) {
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        $(group).prop("checked", false);
        $box.prop("checked", true);
    } else {
        $box.prop("checked", false);
    }
});
</script>
@endsection
