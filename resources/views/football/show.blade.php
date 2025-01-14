@extends('layout.app')

@section('content')
<!-- Title and Image Content -->
<div class="container-fluid d-pg1">
    <div class="row">
        <div class="col-4">
            <div class="card1">
                <span class="badge text-bg-danger">Tranding</span>
                <span class="badge text-bg-secondary">Football</span>
                <h1>{{ $article->title }}</h1>
                <a href="" type="button" class="btn btn-outline-dark">Request Advertorial</a>
                <a href="" type="button" class="btn btn-outline-dark"><svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.53033 10.4697C1.23744 10.1768 0.762563 10.1768 0.46967 10.4697C0.176777 10.7626 0.176777 11.2374 0.46967 11.5303L1.53033 10.4697ZM6.46967 17.5303C6.76256 17.8232 7.23744 17.8232 7.53033 17.5303C7.82322 17.2374 7.82322 16.7626 7.53033 16.4697L6.46967 17.5303ZM6.46962 16.4697C6.17672 16.7626 6.17672 17.2374 6.46961 17.5303C6.76251 17.8232 7.23738 17.8232 7.53028 17.5303L6.46962 16.4697ZM13.5303 11.5303C13.8232 11.2374 13.8232 10.7626 13.5303 10.4697C13.2374 10.1768 12.7625 10.1768 12.4696 10.4697L13.5303 11.5303ZM6.24996 17C6.24996 17.4142 6.58575 17.75 6.99996 17.75C7.41418 17.75 7.74996 17.4142 7.74996 17L6.24996 17ZM7.74996 1C7.74996 0.585785 7.41418 0.25 6.99996 0.25C6.58575 0.25 6.24996 0.585785 6.24996 1L7.74996 1ZM0.46967 11.5303L6.46967 17.5303L7.53033 16.4697L1.53033 10.4697L0.46967 11.5303ZM7.53028 17.5303L13.5303 11.5303L12.4696 10.4697L6.46962 16.4697L7.53028 17.5303ZM7.74996 17L7.74996 1L6.24996 1L6.24996 17L7.74996 17Z" fill="#F6F6F6"/></svg>
                </a>
                </div>
            </div>
            <div class="col-8"><img src="{{asset('img/image-football-pg-2-1.png')}}" alt=""></div>
    </div>      
</div>
<!-- Detail Content (ada 3 bagian images. 1 image diheader, 2 images tengah halaman dan 1 akhir halaman. Terdapat headline kalimat dibagian atas dan tengah halaman. berisi kalimat yang menarik minat pembaca) -->
<div class="container-fluid d-pg2">
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="header">
                    <img src="{{asset('/img/Profile.png')}}" alt="">
                    <p>By Ludus <br> <span>{{date_format($article->created_at,"d M Y")}}<span></p>
                    <hr>
                </div>
                <h1>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolores deleniti accusamus consequuntur et voluptatum illo perferendis, sed molestiae.</h1>
                {!! html_entity_decode($article->content) !!}
                <div class="row">
                    <div class="col-6">
                        <img src="{{asset('/img/image-detail-k2.png')}}" alt="">
                    </div>
                    <div class="col-6">
                        <img src="{{asset('/img/image-detail-k2.png')}}" alt="">
                    </div>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt suscipit voluptas recusandae velit molestias expedita magni nostrum, laboriosam voluptatibus eius illum odit voluptatum ad quisquam assumenda doloremque necessitatibus ipsam aspernatur ex eveniet. Enim aliquam doloribus inventore illo unde culpa magni, quasi, fuga sed nostrum sint. Doloremque impedit ipsam eveniet eaque atque, illo est eius illum ab mollitia iusto repellendus? Commodi, ratione id. Perferendis adipisci laboriosam sint eaque, delectus eveniet quos sequi ratione amet quae minus laborum earum aut obcaecati voluptatum corporis, assumenda ipsum doloremque deserunt animi dolorem ab numquam molestias? Illo provident in quos unde quaerat cum autem, fuga blanditiis ut velit.</p>
                <hr>
                <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, ullam. Aliquid, aperiam error soluta suscipit iure omnis assumenda ut odit. Vel animi fugiat at quibusdam.</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt repudiandae provident adipisci cupiditate tempore, quia iusto itaque fugit repellat nostrum neque, veritatis sint reprehenderit nihil porro, qui assumenda sapiente voluptatum. Sapiente, ut dolorem recusandae corrupti id minus voluptate deleniti iure quas! Quibusdam libero minus in possimus sed esse cumque, quisquam similique quasi quidem rerum odit rem consequatur minima sunt, voluptatem enim perferendis fugit a corporis illo eveniet! Architecto delectus repellendus totam voluptate, necessitatibus recusandae harum voluptatum soluta quas numquam tenetur blanditiis provident eius molestiae distinctio magni maiores aspernatur maxime ratione assumenda nihil. Odio tempore officia voluptatibus non cumque inventore consequatur ducimus! Aperiam ad dolorem est, quidem optio perferendis quam magnam, corporis ducimus tempora reiciendis dolor dolores possimus quibusdam cumque ratione hic debitis alias doloribus sed dolorum cum eaque ea.</p>
                <div class="row">
                    <div class="col">
                        <img src="{{asset('/img/img-football-2.jpg')}}" alt="">
                    </div>
                </div>
                <hr>
                <h4>Related Tags</h4>
                <!-- mengarah ke link sesuai kategori -->
                <a href=""><span class="badge text-bg-secondary">Trending</span></a>
                <a href=""><span class="badge text-bg-secondary">New</span></a>
                <a href=""><span class="badge text-bg-secondary">Football</span></a>
                <a href=""><span class="badge text-bg-secondary">Volley</span></a>
                <a href=""><span class="badge text-bg-secondary">Badminton</span></a>
                <a href=""><span class="badge text-bg-secondary">Taekwondo</span></a>
                <a href=""><span class="badge text-bg-secondary">Karate</span></a>
                <a href=""><span class="badge text-bg-secondary">Pencak Silat</span></a>
                <hr>
                <h4 class="share">Share</h4>
                <!-- fb -->
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M3 16C3 22.4278 7.69444 27.7722 13.8333 28.8556L13.9058 28.7976C13.8816 28.7929 13.8575 28.7882 13.8333 28.7833V19.6111H10.5833V16H13.8333V13.1111C13.8333 9.86111 15.9278 8.05556 18.8889 8.05556C19.8278 8.05556 20.8389 8.2 21.7778 8.34444V11.6667H20.1167C18.5278 11.6667 18.1667 12.4611 18.1667 13.4722V16H21.6333L21.0556 19.6111H18.1667V28.7833C18.1425 28.7882 18.1184 28.7929 18.0942 28.7976L18.1667 28.8556C24.3056 27.7722 29 22.4278 29 16C29 8.85 23.15 3 16 3C8.85 3 3 8.85 3 16Z" fill="#060606"/></svg>

                <!-- ig -->
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.0003 3.39392C12.5768 3.39392 12.1471 3.40889 10.8025 3.47008C9.46056 3.53154 8.54455 3.744 7.74304 4.05574C6.91395 4.37772 6.21066 4.80843 5.51 5.50938C4.8088 6.21006 4.37811 6.91338 4.05509 7.74222C3.74257 8.54402 3.52985 9.46033 3.46945 10.8018C3.40931 12.1465 3.39355 12.5764 3.39355 16C3.39355 19.4236 3.40879 19.8519 3.46971 21.1966C3.53143 22.5386 3.74389 23.4546 4.05535 24.2562C4.37759 25.0853 4.80828 25.7886 5.50921 26.4893C6.20961 27.1905 6.9129 27.6222 7.74146 27.9442C8.5435 28.256 9.45977 28.4684 10.8015 28.5299C12.1461 28.5911 12.5755 28.606 15.9987 28.606C19.4225 28.606 19.8508 28.5911 21.1954 28.5299C22.5374 28.4684 23.4544 28.256 24.2565 27.9442C25.0853 27.6222 25.7875 27.1905 26.4879 26.4893C27.1891 25.7886 27.6198 25.0853 27.9429 24.2564C28.2527 23.4546 28.4655 22.5383 28.5285 21.1968C28.5889 19.8522 28.6046 19.4236 28.6046 16C28.6046 12.5764 28.5889 12.1467 28.5285 10.8021C28.4655 9.46006 28.2527 8.54402 27.9429 7.74249C27.6198 6.91338 27.1891 6.21006 26.4879 5.50938C25.7868 4.80816 25.0856 4.37746 24.2557 4.05574C23.4521 3.744 22.5355 3.53154 21.1936 3.47008C19.849 3.40889 19.4209 3.39392 15.9963 3.39392H16.0003ZM14.8694 5.66564C15.2051 5.66511 15.5796 5.66564 16.0003 5.66564C19.366 5.66564 19.7649 5.67772 21.094 5.73812C22.3231 5.79433 22.9901 5.9997 23.4345 6.17224C24.0227 6.40073 24.4422 6.67386 24.8831 7.11507C25.3243 7.55628 25.5974 7.97649 25.8264 8.56477C25.9989 9.00861 26.2046 9.67568 26.2605 10.9048C26.3209 12.2337 26.3341 12.6328 26.3341 15.9971C26.3341 19.3613 26.3209 19.7605 26.2605 21.0894C26.2043 22.3185 25.9989 22.9856 25.8264 23.4294C25.5979 24.0177 25.3243 24.4366 24.8831 24.8775C24.4419 25.3187 24.023 25.5919 23.4345 25.8204C22.9907 25.9937 22.3231 26.1985 21.094 26.2547C19.7652 26.3152 19.366 26.3283 16.0003 26.3283C12.6343 26.3283 12.2354 26.3152 10.9065 26.2547C9.67749 26.198 9.01044 25.9926 8.56582 25.8201C7.97756 25.5916 7.55737 25.3185 7.11617 24.8773C6.67497 24.4361 6.40185 24.0169 6.17284 23.4284C6.0003 22.9845 5.79467 22.3175 5.73874 21.0884C5.67833 19.7595 5.66625 19.3603 5.66625 15.9939C5.66625 12.6276 5.67833 12.2305 5.73874 10.9016C5.79494 9.67253 6.0003 9.00546 6.17284 8.56109C6.40132 7.97281 6.67497 7.55261 7.11617 7.1114C7.55737 6.67018 7.97756 6.39705 8.56582 6.16804C9.01017 5.99471 9.67749 5.78986 10.9065 5.7334C12.0694 5.68087 12.5201 5.66511 14.8694 5.66249V5.66564ZM22.7291 7.75877C21.894 7.75877 21.2164 8.43556 21.2164 9.27097C21.2164 10.1061 21.894 10.7837 22.7291 10.7837C23.5642 10.7837 24.2418 10.1061 24.2418 9.27097C24.2418 8.43582 23.5642 7.75824 22.7291 7.75824V7.75877ZM16.0003 9.52624C12.4253 9.52624 9.52674 12.4249 9.52674 16C9.52674 19.5751 12.4253 22.4724 16.0003 22.4724C19.5753 22.4724 22.4728 19.5751 22.4728 16C22.4728 12.4249 19.575 9.52624 16 9.52624H16.0003ZM16.0003 11.798C18.3208 11.798 20.2022 13.6792 20.2022 16C20.2022 18.3205 18.3208 20.202 16.0003 20.202C13.6795 20.202 11.7984 18.3205 11.7984 16C11.7984 13.6792 13.6795 11.798 16.0003 11.798Z" fill="#060606"/></svg>

                <!-- wa -->
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M17.1861 2.93995C20.4055 3.09817 23.4054 4.42575 25.6966 6.71854C28.1406 9.16408 29.4859 12.4148 29.4846 15.8719C29.4816 23.0058 23.674 28.8103 16.5397 28.8103C13.8568 28.8103 11.7248 27.986 10.3482 27.2355L3.48584 29.0347L5.32236 22.33C4.18954 20.3678 3.59345 18.1421 3.59438 15.8616C3.59725 8.72788 9.40437 2.92395 16.5395 2.92395L17.1861 2.93995ZM10.6661 24.8932L11.059 25.1262C12.711 26.106 14.6046 26.6245 16.5352 26.6252H16.5396C22.4699 26.6252 27.2965 21.8009 27.2989 15.8712C27.3 12.9977 26.1819 10.2958 24.1506 8.26311C22.1191 6.23031 19.4177 5.11018 16.5439 5.10925C10.6091 5.10925 5.78238 9.93309 5.78002 15.8624C5.77921 17.8944 6.34802 19.8734 7.42505 21.5855L7.68087 21.9925L6.59394 25.9608L10.6661 24.8932ZM23.0612 18.9486C22.9804 18.8137 22.7648 18.7328 22.4413 18.571C22.1179 18.4092 20.5276 17.6271 20.2311 17.5191C19.9347 17.4114 19.719 17.3575 19.5034 17.681C19.2878 18.0046 18.6679 18.7328 18.4792 18.9486C18.2906 19.1644 18.1019 19.1914 17.7785 19.0296C17.455 18.8678 16.4128 18.5263 15.1774 17.4249C14.2158 16.5676 13.5666 15.509 13.3779 15.1854C13.1893 14.8618 13.3578 14.6867 13.5197 14.5256C13.6653 14.3807 13.8433 14.1479 14.005 13.9592C14.1667 13.7704 14.2206 13.6355 14.3284 13.4198C14.4362 13.204 14.3823 13.0153 14.3015 12.8535C14.2206 12.6916 13.5737 11.1003 13.3042 10.4529C13.0416 9.82261 12.7749 9.90794 12.5764 9.89799C12.388 9.88865 12.1721 9.88659 11.9565 9.88659C11.7409 9.88659 11.3905 9.96745 11.094 10.2912C10.7975 10.6148 9.96191 11.397 9.96191 12.9882C9.96191 14.5795 11.121 16.1167 11.2827 16.3325C11.4444 16.5484 13.5635 19.8136 16.8081 21.2141C17.5798 21.5472 18.1823 21.7461 18.6521 21.8951C19.4269 22.1412 20.132 22.1065 20.6894 22.0232C21.3108 21.9304 22.603 21.2411 22.8726 20.486C23.1421 19.7307 23.1421 19.0835 23.0612 18.9486Z" fill="#060606"/></svg>

                <!-- twitter -->
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M27.2259 10.3505C27.2357 10.6031 27.239 10.8556 27.239 11.1083C27.239 18.767 21.8515 27.6085 11.9995 27.6085C8.97315 27.6085 6.15909 26.644 3.78809 25.002C4.2072 25.048 4.63286 25.0825 5.06503 25.0825C7.57429 25.0825 9.88542 24.1522 11.7186 22.5906C9.37486 22.5562 7.39577 20.8683 6.71321 18.5718C7.04088 18.6407 7.37832 18.6752 7.72342 18.6752C8.21003 18.6752 8.68248 18.6064 9.13535 18.4686C6.6827 17.9404 4.83534 15.5981 4.83534 12.7849C4.83534 12.7505 4.83534 12.7389 4.83534 12.716C5.55818 13.1408 6.38551 13.4048 7.26402 13.4392C5.82488 12.3943 4.87886 10.6146 4.87886 8.60518C4.87886 7.5488 5.1423 6.54979 5.60605 5.68861C8.24703 9.20221 12.1955 11.5102 16.6468 11.7513C16.5554 11.3265 16.5085 10.8788 16.5085 10.431C16.5085 7.22739 18.9067 4.63232 21.8656 4.63232C23.406 4.63232 24.7972 5.33285 25.7737 6.45812C26.9962 6.20551 28.1415 5.72328 29.1778 5.05731C28.7761 6.41222 27.9281 7.54874 26.8199 8.26065C27.9041 8.12286 28.9383 7.81307 29.8974 7.35378C29.1778 8.5135 28.2721 9.53527 27.2259 10.3505Z" fill="#060606"/></svg>

                

            </div>
            <div class="col-3"></div>
        </div>
    </div>
</div>
 <!-- diisi data artikel terkait, 4 artikel tiap pagenya -->
<div class="container-fluid d-pg3">
    <h2>You May Also Interested</h2>
    <div class="row">
        @for($i=1;$i<=4;$i++)
        <div class="col-3">
            <div class="card">
                <img src="{{asset('img/image-football-pg-2-'.$i.'.png')}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <span class="badge text-bg-danger">Tranding</span>
                    <span class="badge text-bg-secondary">Football</span>
                    <!-- Button trigger modal -->
                    <a href="#" type="button" class="btn btn-danger report" data-bs-toggle="modal" data-bs-target="#reportModal">
                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.5 11.6667C7.73611 11.6667 7.93417 11.5867 8.09417 11.4267C8.25417 11.2667 8.33389 11.0689 8.33333 10.8333C8.33278 10.5978 8.25278 10.4 8.09333 10.24C7.93389 10.08 7.73611 10 7.5 10C7.26389 10 7.06611 10.08 6.90667 10.24C6.74722 10.4 6.66722 10.5978 6.66667 10.8333C6.66611 11.0689 6.74611 11.2669 6.90667 11.4275C7.06722 11.5881 7.265 11.6678 7.5 11.6667ZM6.66667 8.33333H8.33333V3.33333H6.66667V8.33333ZM4.375 15L0 10.625V4.375L4.375 0H10.625L15 4.375V10.625L10.625 15H4.375ZM5.08333 13.3333H9.91667L13.3333 9.91667V5.08333L9.91667 1.66667H5.08333L1.66667 5.08333V9.91667L5.08333 13.3333Z" fill="#060606"/></svg>
                    </a>
                    <h5 class="card-title">The Big Australian Music Festival Is Dead. What Next?</h5>
                    <p class="card-text">12 Feb 2024</p>
                    <ul>
                        <li>By Admin</li>
                    </ul>
                </div>
            </div>
        </div>
        @endfor
    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
            <a class="page-link">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
            <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</div>
@endsection