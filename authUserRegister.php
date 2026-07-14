<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Create your secure account on Digital Kamety and join a trusted community savings pool.">
    <title>Join Digital Kamety | Create Your Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <?php require_once 'conection.php';
    error_reporting(1);
    unset($_SESSION['tokenSet']);
    $randToken = rand(1111, 9999).time().date('s');
    $newToken = md5($randToken);
    $_SESSION['tokenSet'] = $newToken; ?>
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
    <div class="flex min-h-full">
        <div
            class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white z-10 shadow-xl">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div class="mb-10 text-center lg:text-left">
                    <div class="inline-flex items-center space-x-2 mb-4">
                        <div class="bg-brand-600 text-white p-2.5 rounded-xl shadow-md shadow-brand-600/20">
                            <i class="fa-solid fa-wallet text-xl"></i>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-dark">Digital<span
                                class="text-brand-600">Kamety</span></span>
                    </div>
                    <h2 class="text-3xl font-black tracking-tight text-dark">Create account</h2>
                    <p class="mt-2 text-sm text-slate-500">
                        Already a member?
                        <a href="#" class="font-semibold text-brand-600 hover:text-brand-700 transition">Sign in to
                            dashboard</a>
                    </p>
                </div>

                <div class="space-y-6">
                    <form action="authRegisterProcess" enctype="multipart/form-data" method="POST" class="space-y-5">
                        <?php
                        if (!empty($_GET['affiliateCode'])) {
                            $query1 = "SELECT name, topup_flag FROM sub_admin_user_details WHERE user_id='$_GET[affiliateCode]'";
                            $result1 = mysqli_query($con, $query1);
                            $val1 = mysqli_fetch_assoc($result1);
                            $sponser_name = $val1['name']; ?>

                        <div>
                            <label for="sponsorId"
                                class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Sponsor
                                Id</label>
                            <div class="relative rounded-xl shadow-sm">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                                    <i class="fa-regular fa-user"></i>
                                </div>
                                <input type="text" id="name" name="sponser_id1" disabled required placeholder="John Doe"
                                    class="block w-full rounded-xl border border-slate-200 bg-slate-50/50 py-3.5 pl-11 pr-4 text-sm text-dark placeholder-slate-400 focus:border-brand-600 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-600/10 transition"
                                    value="<?php echo $_GET['affiliateCode']; ?>">
                            </div>
                        </div>



                        <div class="col-12 col-sm-6">
                            <div class="input-with-icon">
                                <i class="fas fa-user input-icon"></i>
                                <input type="text"
                                    class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2"
                                    name="sponser_id1" disabled value="<?php echo $_GET['affiliateCode']; ?>">
                                <input type="hidden" name="sponser_id" value="<?php echo $_GET['affiliateCode']; ?>">
                            </div>
                        </div>


                        <div class="col-12 col-sm-6">
                            <div class="input-with-icon">
                                <i class="fas fa-user input-icon"></i>
                                <input type="text" class="form-control mb-2" disabled
                                    value="<?php echo $sponser_name; ?>" placeholder="Sponser Name">
                            </div>
                        </div>
                        <?php } else { ?>

                        <div class="col-12 col-sm-6">
                            <div class="input-with-icon">
                                <i class="fas fa-user input-icon"></i>
                                <input class="form-control mb-2" name="sponser_id" required id="sponser_id"
                                    onblur="sponserNewValid(this.value)" placeholder="Sponsor Id">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="input-with-icon">
                                <i class="fas fa-user input-icon"></i>
                                <input type="text" class="form-control mb-2" disabled id="sponsorName"
                                    placeholder="Sponser Name">
                            </div>
                        </div>
                        <?php } ?>


                        <div>
                            <label for="name"
                                class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Full
                                Name</label>
                            <div class="relative rounded-xl shadow-sm">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                                    <i class="fa-regular fa-user"></i>
                                </div>
                                <input type="text" id="name" name="name" required placeholder="John Doe"
                                    class="block w-full rounded-xl border border-slate-200 bg-slate-50/50 py-3.5 pl-11 pr-4 text-sm text-dark placeholder-slate-400 focus:border-brand-600 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-600/10 transition">
                            </div>
                            <input type="hidden" name="goodFile" required value="<?php echo $newToken; ?>">
                        </div>

                        <div>
                            <label for="phone"
                                class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Phone /
                                WhatsApp Number</label>
                            <div class="relative rounded-xl shadow-sm">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-phone-flip text-sm"></i>
                                </div>
                                <input type="tel" id="phone" name="phone" required placeholder="+91 98765 43210"
                                    class="block w-full rounded-xl border border-slate-200 bg-slate-50/50 py-3.5 pl-11 pr-4 text-sm text-dark placeholder-slate-400 focus:border-brand-600 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-600/10 transition">
                            </div>
                        </div>

                        <div>
                            <label for="email"
                                class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Email
                                Address</label>
                            <div class="relative rounded-xl shadow-sm">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                                    <i class="fa-regular fa-envelope"></i>
                                </div>
                                <input type="email" id="email" name="emailId" required placeholder="name@example.com"
                                    class="block w-full rounded-xl border border-slate-200 bg-slate-50/50 py-3.5 pl-11 pr-4 text-sm text-dark placeholder-slate-400 focus:border-brand-600 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-600/10 transition">
                            </div>
                        </div>

                        <!-- <div>
                            <label for="pool"
                                class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Select
                                Initial Savings Pool</label>
                            <div class="relative rounded-xl shadow-sm">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-layer-group text-sm"></i>
                                </div>
                                <input type="number" id="amount" name="amount" required placeholder="₹5,000 / month"
                                    class="block w-full rounded-xl border border-slate-200 bg-slate-50/50 py-3.5 pl-11 pr-4 text-sm text-dark placeholder-slate-400 focus:border-brand-600 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-600/10 transition">
                                <div
                                    class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div> -->

                        <div>
                            <label for="password"
                                class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Create
                                Password</label>
                            <div class="relative rounded-xl shadow-sm">
                                <div
                                    class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400">
                                    <i class="fa-solid fa-lock"></i>
                                </div>
                                <input type="password" id="password" name="password" required placeholder="••••••••"
                                    class="block w-full rounded-xl border border-slate-200 bg-slate-50/50 py-3.5 pl-11 pr-4 text-sm text-dark placeholder-slate-400 focus:border-brand-600 focus:bg-white focus:outline-none focus:ring-2 focus:ring-brand-600/10 transition">
                            </div>
                        </div>

                        <div class="flex items-center">
                            <input id="terms" name="terms" type="checkbox" required
                                class="h-4 w-4 rounded border-slate-300 text-brand-600 focus:ring-brand-600/20 transition">
                            <label for="terms" class="ml-3 text-sm text-slate-600">
                                I agree to the <a href="#" class="font-semibold text-brand-600 hover:underline">Terms of
                                    Service</a> and <a href="#"
                                    class="font-semibold text-brand-600 hover:underline">Committee Rules</a>.
                            </label>
                        </div>

                        <div>
                            <button type="submit" name="submitRegister"
                                class="flex w-full justify-center bg-brand-600 hover:bg-brand-700 text-white py-4 px-4 rounded-xl text-sm font-bold shadow-xl shadow-brand-600/10 transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-brand-600 focus:ring-offset-2">
                                Verify & Start Saving
                            </button>
                        </div>
                    </form>
                </div>

                <p class="mt-8 text-center text-xs text-slate-400 lg:hidden">
                    &copy; 2026 Digital Kamety. All Rights Reserved.
                </p>

            </div>
        </div>

        <div
            class="relative hidden w-0 flex-1 lg:block bg-gradient-to-br from-dark to-slate-900 p-16 flex items-center justify-center">
            <div
                class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-brand-900/30 via-transparent to-transparent">
            </div>

            <div class="relative max-w-md mx-auto space-y-12 text-white">
                <div class="space-y-4">
                    <span
                        class="bg-brand-600/20 text-brand-100 text-xs px-3 py-1 rounded-full border border-brand-600/30 font-bold tracking-wider uppercase">Next
                        Gen Savings</span>
                    <h3 class="text-4xl font-black tracking-tight leading-tight">Your money. Secured by technology,
                        built on community trust.</h3>
                    <p class="text-slate-400 leading-relaxed">Join thousands of verified members coordinating rotating
                        committee pools without hidden interest commissions or physical bookkeeping risks.</p>
                </div>

                <div class="space-y-6">
                    <div class="flex items-center space-x-4">
                        <div
                            class="flex-none bg-emerald-500/10 text-brand-600 p-2.5 rounded-xl border border-emerald-500/20">
                            <i class="fa-solid fa-shield-halved text-lg"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-slate-200">KYC Verified Pool Associates</h5>
                            <p class="text-xs text-slate-400">Zero non-payment risks. Every single account matches
                                verified parameters.</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div
                            class="flex-none bg-emerald-500/10 text-brand-600 p-2.5 rounded-xl border border-emerald-500/20">
                            <i class="fa-solid fa-list-check text-lg"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-slate-200">Transparent Digital Ledgers</h5>
                            <p class="text-xs text-slate-400">Real-time receipts and automated notifications right on
                                your dashboard.</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div
                            class="flex-none bg-emerald-500/10 text-brand-600 p-2.5 rounded-xl border border-emerald-500/20">
                            <i class="fa-solid fa-wand-magic-sparkles text-lg"></i>
                        </div>
                        <div>
                            <h5 class="font-bold text-slate-200">Algorithmic Monthly Draws</h5>
                            <p class="text-xs text-slate-400">Completely unbiased lucky draws conducted live right
                                through the platform system.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-8 border-t border-slate-800 flex items-center justify-between text-xs text-slate-500">
                    <span>&copy; 2026 Digital Kamety.</span>
                    <div class="space-x-4">
                        <a href="#" class="hover:text-slate-400 transition">Privacy Policy</a>
                        <a href="#" class="hover:text-slate-400 transition">Support Center</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
<script src="custom.js"></script>
<script>
function sponserNewValid(sponser_id) {
    document.getElementById("sponsorName").value = "";
    if (!sponser_id == "") {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var v = xmlhttp.responseText;
                if (v.trim() != "") {
                    document.getElementById("sponsorName").value = v.trim();
                } else {
                    alert("Invalid Sponser ID");
                    document.getElementById("sponser_id").value = "";
                }
            }
        }
        xmlhttp.open("GET", "getSponserNameAjax?sponserId=" + sponser_id, true);
        xmlhttp.send();
    }
}
</script>

</html>