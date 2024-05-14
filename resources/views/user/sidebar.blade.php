<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profilePic = document.querySelector(".image img");
        const userFile = document.querySelector("#file-path");
        userFile.onchange = function() {
            profilePic.src = URL.createObjectURL(userFile.files[0]);
        }
    });
</script>

<div class="col-lg-3 col-md-4">
    <form action="{{ route('update.profile') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body text-center wrapper" style="border: 2px solid #ff0000; border-radius: 10px 10px 0px 0px; padding: 20px; height: 250px;">
            <input type="hidden" name="id" value="{{ Auth::user()->id }}">

            <div class="image" style="position: relative;">
                <img src="{{ asset(str_replace('/write', '', Auth::user()->user_photo)) }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;border: 2px solid #ff0000;">
                <label for="file-path">
                    <span class="material-symbols-rounded" style="position: absolute; top: 10%; left: 70%; transform: translate(-50%, -50%); background-color: #fff; border-radius: 50%; padding: 10px;">
                        <i class="fa-solid fa-user-pen"></i>
                    </span>
                </label>
                <input type="file" accept="image/jpeg, image/png, image/jpg" id="file-path" class="user-file dropify" name="user_photo" style="display: none;">
            </div>
            <h5 class="my-3">{{ Auth::user()->name }}</h5>
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-user-pen"></i></button>
        </div>
    </form>
    <div class="dashboard_menu">
        <ul class="nav nav-tabs flex-column" role="tablist">
            <li class="nav-item">
                <a class="nav-link btn-line-fill btn-sm" href="{{ route('home') }}"><i class="fa-solid fa-border-all" style="font-size: 25px;"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-line-fill btn-sm" href="{{ route('wishlist') }}"><i class="icon-heart" style="font-size: 25px;"></i>Wishlist</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-line-fill btn-sm" href="{{ route('my.order') }}"><i class="fa-solid fa-cart-shopping" style="font-size: 25px;"></i>My Order</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-line-fill btn-sm" aria-selected="true" href="{{ route('write.review') }}"><i class="fa-regular fa-pen-to-square" style="font-size: 25px;"></i>Write a review</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-line-fill btn-sm" href="{{ route('customer.setting') }}"><i class="fa-solid fa-sliders" style="font-size: 25px;"></i>Setting</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-line-fill btn-sm" href="{{ route('open.ticket') }}"><i class="fa-solid fa-ticket" style="font-size: 25px;"></i>Open Ticket</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn-line-fill btn-sm" href="{{ route('customer.logout') }}"><i class="fa-solid fa-right-from-bracket" style="font-size: 25px;"></i></i>Logout</a>
            </li>
        </ul>
    </div>
</div>