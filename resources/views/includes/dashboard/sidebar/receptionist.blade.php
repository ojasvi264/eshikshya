<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li><a href="{{route('receptionist.dashboard')}}" aria-expanded="false">
                    <i class="material-icons">dashboard</i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-calendar-check-o"></i>
                    <span class="nav-text">Front Office</span>
                </a>
                <ul aria-expanded="false">
                    <li><a class="has-arrow" href="javascript:void(0)" aria-expanded="false">Setup Front Office</a>
                        <ul>
                            <li><a href="{{route('receptionist.purpose') }}">Purpose</a></li>
                            <li><a href="{{route('receptionist.complain-type') }}">Complain Type</a></li>
                            <li><a href="{{route('receptionist.source') }}">Source</a></li>
                            <li><a href="{{route('receptionist.reference') }}">Reference</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('receptionist.admission-inquiry')}}">Admission Inquiry</a></li>
                    <li><a href="{{route('receptionist.visitor-book')}}">Visitor Book</a></li>
                    <li><a href="{{route('receptionist.phone-call-log')}}">Phone Call Log</a></li>
                    <li><a href="{{route('receptionist.postal-dispatch')}}">Postal Dispatch</a></li>
                    <li><a href="{{route('receptionist.postal-receive')}}">Postal Receive</a></li>
                    <li><a href="{{route('receptionist.complain')}}">Complain</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-users"></i>
                    <span class="nav-text">Leave</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('receptionist.apply_leave.index') }}">Apply Leave</a></li>
                </ul>
            </li>
{{--            <li>--}}
{{--                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">--}}
{{--                    <i class="la la-building"></i>--}}
{{--                    <span class="nav-text">Inventory</span>--}}
{{--                </a>--}}
{{--                <ul aria-expanded="false">--}}
{{--                    <li><a href="{{route('item_category.index') }}">Item Category</a></li>--}}
{{--                    <li><a href="{{route('item_store.index') }}">Item Store</a></li>--}}
{{--                    <li><a href="{{route('item_supplier.index') }}">Item Supplier</a></li>--}}
{{--                    <li><a href="{{route('item.index') }}">Item</a></li>--}}
{{--                    <li><a href="{{route('item_stock.index') }}">Item Stock</a></li>--}}
{{--                    <li><a href="{{route('issue_item.index') }}">Issue Item</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
        </ul>
    </div>
</div>
