<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../public/css/global.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shrikhand&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="font-poppins">
    <?php
    Message::flash();
    ?>
    <nav id="navbar" class="px-12 pt-8 fixed inset-x-0 top-0  bg-transparent transition-all duration-300 z-50">
        <div class="border-b-2 border-black flex justify-between items-center pb-2">
            <p class="font-shrikhand">WasteCare</p>
            <ul class="flex justify-between w-2/5 items-center">
                <li><a href="<?= BASEURL . '' ?>">Home</a></li>
                <li><a href="<?= BASEURL . '/about' ?>">About</a></li>
                <li class=""><a href="<?= BASEURL . '/services' ?>">Services</a></li>
                <!-- <li><a href="<?php // BASEURL . '/blogs' ?>">Blogs</a></li> -->
                <?php if (!isset($_SESSION['user'])) : ?>
                    <li><a href="<?= BASEURL . '/login' ?>" class="action-btn rounded-full border-black border-1 py-1 px-6">Login</a></li>
                <?php else : ?>
                    <li>
                        <button id="userMenuBtn" class="action-btn rounded-full border-black border-1 py-1 px-6 flex items-center gap-2">
                            My Account
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div class="absolute hidden border border-1 mt-2 overflow-hidden bg-white rounded-lg text-black flex flex-col" id="userMenu">
                            <a href="<?= BASEURL ?>" class="py-1 px-6 hover:bg-gray-200">Profile</a>
                            <?php if ($_SESSION['user']['role'] == 'admin') : ?>
                                <a href="<?= BASEURL . '/admin/dashboard' ?>" class="py-1 px-6 hover:bg-gray-200">My Dashboard</a>
                            <?php else : ?>
                                <a href="<?= BASEURL . '/subscription' ?>" class="py-1 px-6 hover:bg-gray-200">My Subscription</a>
                            <?php endif; ?>
                            <a href="<?= BASEURL . '/logout' ?>" class="py-1 px-6 hover:bg-gray-200">Log Out</a>
                        </div>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </nav>