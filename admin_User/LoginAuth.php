<?php
// Initialize login feedback messages if handled by your auth logic
$errorMessage = '';
if (isset($_GET['error'])) {
    $errorMessage = 'Invalid User ID or Password. Please try again.';
}
?>
<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login to your Digital Kamety dashboard.">
    <title>Login | Digital Kamety</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            600: '#16a34a',
                            700: '#15803d',
                            900: '#14532d',
                        },
                        dark: '#0f172a',
                    }
                }
            }
        }
    </script>
</head>

<body class="h-full font-sans antialiased text-slate-800">

    <div class="flex min-h-full flex-col-reverse lg:flex-row">

        <!-- Left Side: Login Form Panel (Matches spacing of image_a4b3e3.jpg) -->
        <div class="flex flex-1 flex-col justify-center px-6 py-12 sm:px-12 lg:flex-none lg:w-[50%] xl:px-24 bg-white">
            <div class="mx-auto w-full max-w-sm sm:max-w-md">

                <!-- Header Text -->
                <div class="text-left mb-8">
                    <span class="text-xs font-bold tracking-wide text-slate-400 block mb-1">Smart savings to a better
                        life.</span>
                    <h2 class="text-4xl font-black tracking-tight text-slate-900 uppercase">Admin Login</h2>
                </div>

                <?php if (!empty($errorMessage)) { ?>
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-xl text-sm font-medium">
                        <?php echo htmlspecialchars($errorMessage); ?>
                    </div>
                <?php } ?>

                <!-- Form Formulating Action Box -->
                <form action="login-process" method="POST" class="space-y-5">

                    <!-- User ID Input Field -->
                    <div>
                        <div class="relative rounded-xl shadow-sm">
                            <div
                                class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                                <i class="fa-regular fa-user"></i>
                            </div>
                            <input type="text" id="inputUserId" aria-label="UserId"
                                class="block w-full rounded-xl border border-slate-200 bg-white py-3.5 pl-11 pr-4 text-sm text-dark placeholder-slate-400 focus:border-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-600/10 transition"
                                placeholder="User Id" data-val="true" data-val-required="User ID is Required" value="<?php if (isset($_COOKIE[' memberUserId'])) {
                                    echo $_COOKIE['memberUserId'];
                                } ?>" />
                        </div>
                    </div>

                    <!-- Password Input Field -->
                    <div>
                        <div class="relative rounded-xl shadow-sm">
                            <div
                                class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <input type="password" aria-label="Password"
                                class="block w-full rounded-xl border border-slate-200 bg-white py-3.5 pl-11 pr-4 text-sm text-dark placeholder-slate-400 focus:border-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-600/10 transition"
                                id="inputPassword" placeholder="Password" data-val-required="Password is Required"
                                required onkeypress="return catchEnter(event)" value="<?php if (isset($_COOKIE[' memberPassKey'])) {
                                    echo $_COOKIE['memberPassKey'];
                                } ?>" />
                        </div>
                    </div>

                    <!-- Forgot Password Link Position -->
                    <div class="text-left text-xs">
                        <span class="text-slate-400">Forgot Password ?</span>
                        <a href="forgot-password.php"
                            class="font-bold text-brand-600 hover:text-brand-700 hover:underline ml-1">Click Here</a>
                    </div>

                    <!-- Login Button -->
                    <div class="pt-2">

                        <button id="loginSubmit"
                            class="flex w-full justify-center bg-brand-600 hover:bg-brand-700 text-white py-4 px-4 rounded-xl text-sm font-bold shadow-xl shadow-brand-600/10 transition transform hover:-translate-y-0.5 text-center items-center"
                            onclick="LoginValidate()" type="button">
                            Login Now
                        </button>
                        <button disabled style="display: none;"
                            class="btn btn-warning w-100 fw-bold py-2 loadingMore">Validating Data...</button>
                    </div>
                </form>

                <!-- Alternate Option Redirection Link -->
                <div class="mt-8 text-center text-xs text-slate-500">
                    <span>Don't have an account?</span>
                    <a href="../authUserRegister"
                        class="font-bold text-brand-600 hover:text-brand-700 hover:underline ml-1">New Register</a>
                </div>

            </div>
        </div>

        <!-- Right Side: Brand Showcase Panel (Replaces Future Vision from image_a4b3e3.jpg) -->
        <div
            class="relative flex-1 bg-gradient-to-br from-brand-900 to-emerald-950 px-8 py-16 lg:p-16 flex flex-col justify-center items-center text-center border-b lg:border-b-0 border-slate-800">
            <div
                class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-brand-700/20 via-transparent to-transparent">
            </div>

            <div class="relative max-w-md mx-auto space-y-6 text-white flex flex-col items-center">
                <!-- Clean Modern Icon Representation -->
                <div
                    class="bg-white/10 backdrop-blur-md h-28 w-28 rounded-3xl flex items-center justify-center text-4xl shadow-2xl border border-white/10 text-brand-100 mb-4 animate-pulse">
                    <i class="fa-solid fa-vault"></i>
                </div>

                <div class="space-y-2">
                    <h3 class="text-3xl font-black tracking-wider uppercase">
                        Digital<span class="text-brand-600">Kamety</span>
                    </h3>
                    <p class="text-xs tracking-widest text-brand-200 uppercase font-bold">Community Savings Vault</p>
                </div>
                <p class="text-sm text-brand-100/70 max-w-xs leading-relaxed font-medium">
                    Access your active committees, view dynamic lucky draws, and manage your monthly payouts securely.
                </p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="custom.js"></script>
    <script crossorigin="anonymous" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>