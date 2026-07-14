<?php
// Initialize fallback values if data isn't received from the registration script
$fullName = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : (isset($_GET['name']) ? htmlspecialchars($_GET['name']) : 'lalit kumar');
$userId = isset($_POST['user_id']) ? htmlspecialchars($_POST['user_id']) : (isset($_GET['user_id']) ? htmlspecialchars($_GET['user_id']) : 'DK737127');

?>
<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Kamety Registration Complete. Welcome to your digital savings circle.">
    <title>Registration Successful | Digital Kamety</title>
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

        <!-- Left Side: Success Details Panel -->
        <div class="flex flex-1 flex-col justify-center px-6 py-12 sm:px-12 lg:flex-none lg:w-[50%] xl:px-24 bg-white">
            <div class="mx-auto w-full max-w-sm sm:max-w-md">

                <!-- Success Messaging -->
                <div class="text-left">
                    <span class="text-xs font-bold uppercase tracking-widest text-brand-600 block mb-1">Registration
                        Complete</span>
                    <h2 class="text-4xl sm:text-5xl font-black tracking-tight text-slate-900 mb-3">Success</h2>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Kindly check your registered email for account configuration and circle guidelines.
                    </p>
                </div>

                <!-- Generated Credentials Box (Matches image_a51d7a.jpg style exactly with PHP variables) -->
                <div class="mt-8 border-t border-b border-slate-100 py-6 space-y-4">
                    <div class="flex justify-between items-center text-sm">
                        <span class="font-bold text-slate-700">Full Name</span>
                        <span class="font-semibold text-slate-900 bg-slate-50 px-3 py-1 rounded-lg">
                            <?php echo $fullName; ?>
                        </span>
                    </div>

                    <div class="flex justify-between items-center text-sm">
                        <span class="font-bold text-slate-700">User ID</span>
                        <span
                            class="font-mono font-bold text-brand-700 bg-brand-50 border border-brand-100 px-3 py-1 rounded-lg tracking-wider">
                            <?php echo $userId; ?>
                        </span>
                    </div>

                    <div class="flex justify-between items-center text-sm">
                        <span class="font-bold text-slate-700">Login Password</span>
                        <span class="text-slate-400 italic text-xs">Sent to registered email</span>
                    </div>

                    <div class="flex justify-between items-center text-sm">
                        <span class="font-bold text-slate-700">Transaction PIN</span>
                        <span class="text-slate-400 italic text-xs">Sent securely to WhatsApp</span>
                    </div>
                </div>

                <!-- Action Intersections -->
                <div class="mt-8 space-y-4">
                    <a href="admin_User/"
                        class="flex w-full justify-center bg-brand-600 hover:bg-brand-700 text-white py-4 px-4 rounded-xl text-sm font-bold shadow-xl shadow-brand-600/10 transition transform hover:-translate-y-0.5 text-center items-center space-x-2">
                        <span>Login Now</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>

                    <div class="flex items-center justify-between pt-4 text-xs">
                        <span class="text-slate-400">Need another workspace account?</span>
                        <a href="authUserRegister"
                            class="border border-slate-200 text-slate-700 hover:border-brand-600 hover:text-brand-600 px-4 py-2 rounded-xl font-semibold transition">
                            New Register
                        </a>
                    </div>
                </div>

            </div>
        </div>

        <!-- Right Side: Brand Showcase Panel (Mirrors graphic positioning from image_a51d7a.jpg) -->
        <div
            class="relative flex-1 bg-gradient-to-br from-brand-900 to-emerald-950 px-8 py-16 lg:p-16 flex flex-col justify-center items-center text-center border-b lg:border-b-0 border-slate-800">
            <div
                class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-brand-700/20 via-transparent to-transparent">
            </div>

            <div class="relative max-w-md mx-auto space-y-6 text-white flex flex-col items-center">
                <!-- Clean Modern Icon Asset Integration -->
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
                    Your registration parameters are permanently locked. Your savings lifecycle starts next month.
                </p>
            </div>
        </div>

    </div>

</body>

</html>