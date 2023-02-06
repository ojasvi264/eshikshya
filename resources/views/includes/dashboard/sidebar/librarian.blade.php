<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            <li>
                <a href="{{route('librarian.dashboard')}}" aria-expanded="false">
                    <i class="material-icons">dashboard</i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-users"></i>
                    <span class="nav-text">Leave</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('librarian.apply_leave.index') }}">Apply Leave</a></li>
                </ul>
            </li>
            <li>
                <a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
                    <i class="la la-book"></i>
                    <span class="nav-text">Library</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{route('librarian.book.index')}}">Book List</a></li>
                    <li><a href="{{route('librarian.library_staff_member.index')}}">Add Staff Member</a></li>
                    <li><a href="{{route('librarian.library_student_member.index')}}">Add Student Member</a></li>
                    <li><a href="{{route('librarian.issue_return.index')}}">Issue Return</a></li>
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
