<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Styles -->
        <link href="https://db.onlinewebfonts.com/c/44620fe64734f268ad07740e6ec5127d?family=CoolveticaRg-Regular+V1" rel="stylesheet" type="text/css"/>
        <link href="https://db.onlinewebfonts.com/c/0754a87a6aa14ab86abe03e805d71adf?family=CoolveticaCondensedRg-Regular" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- <script src="{{ asset('js/bootstrap.js') }}"></script> -->

    </head>
    <body>
        <div class="container-fluid signup">
            <div class="row">
                <div class="col-6">
                    <img class="img1" src="{{ asset('img/image-signup.png') }}" alt="">
                </div>
                <div class="col-6">
                    <div class="container">
                        <h1>Sign Up</h1>
                        <form>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email/No.HP</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email/No.HP">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password">
                            </div>
                            <button type="submit" class="btn btn-primary mb-3">Sign Up</button>
                            <button type="submit" class="btn btn-outline-primary mb-3">
                                <svg width="18" height="17" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.1712 6.86794H16.5V6.83335H8.99996V10.1667H13.7095C13.0225 12.1071 11.1762 13.5 8.99996 13.5C6.23871 13.5 3.99996 11.2613 3.99996 8.50002C3.99996 5.73877 6.23871 3.50002 8.99996 3.50002C10.2745 3.50002 11.4341 3.98085 12.317 4.76627L14.6741 2.40919C13.1858 1.0221 11.195 0.166687 8.99996 0.166687C4.39788 0.166687 0.666626 3.89794 0.666626 8.50002C0.666626 13.1021 4.39788 16.8334 8.99996 16.8334C13.602 16.8334 17.3333 13.1021 17.3333 8.50002C17.3333 7.94127 17.2758 7.39585 17.1712 6.86794Z" fill="#FFC107"/>
                                <path d="M1.62744 4.62127L4.36536 6.62919C5.10619 4.79502 6.90036 3.50002 8.99994 3.50002C10.2745 3.50002 11.4341 3.98085 12.317 4.76627L14.6741 2.40919C13.1858 1.0221 11.1949 0.166687 8.99994 0.166687C5.79911 0.166687 3.02327 1.97377 1.62744 4.62127Z" fill="#FF3D00"/>
                                <path d="M9.00005 16.8334C11.1525 16.8334 13.1084 16.0096 14.5871 14.67L12.008 12.4875C11.1432 13.1452 10.0865 13.5009 9.00005 13.5C6.83255 13.5 4.99213 12.118 4.2988 10.1892L1.5813 12.283C2.96047 14.9817 5.7613 16.8334 9.00005 16.8334Z" fill="#4CAF50"/>
                                <path d="M17.1712 6.86796H16.5V6.83337H9V10.1667H13.7096C13.3809 11.0902 12.7889 11.8972 12.0067 12.488L12.0079 12.4871L14.5871 14.6696C14.4046 14.8355 17.3333 12.6667 17.3333 8.50004C17.3333 7.94129 17.2758 7.39587 17.1712 6.86796Z" fill="#1976D2"/></svg>

                                Sign Up Via Google
                            </button>
                        </form>
                        <p class="text-center">Already have an account? <a href="/login">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
        
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    </body>
</html>
