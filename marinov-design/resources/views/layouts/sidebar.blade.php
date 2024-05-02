<div x-cloak :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
    class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

<div x-cloak :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
    class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
            <span class="mx-2 text-2xl font-semibold text-white">Dashboard</span>
        </div>
    </div>

    <nav class="mt-10">
        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" href="/">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
            </svg>

            <span class="mx-3">Dashboard</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
            href="{{ route('products.index') }}">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
            </svg>

            <span class="mx-3">
                Products
            </span>
        </a>

        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
            href="{{ route('types.index') }}">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>

            <span class="mx-3">Types</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
            href="{{ route('materials.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><path fill="currentColor" d="M12 21L2 9l3-6h14l3 6zM9.625 8h4.75l-1.5-3h-1.75zM11 16.675V10H5.45zm2 0L18.55 10H13zM16.6 8h2.65l-1.5-3H15.1zM4.75 8H7.4l1.5-3H6.25z"/></svg>            <span class="mx-3">Materials</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
            href="{{ route('maintenances.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><path fill="currentColor" d="M19.56 11.36L13 8.44V7c0-.55-.45-1-1-1s-1-.45-1-1s.45-1 1-1s1 .45 1 1h2c0-1.84-1.66-3.3-3.56-2.95c-1.18.22-2.15 1.17-2.38 2.35c-.3 1.56.6 2.94 1.94 3.42v.63l-6.56 2.92c-.88.38-1.44 1.25-1.44 2.2v.01C3 14.92 4.08 16 5.42 16H7v6h10v-6h1.58c1.34 0 2.42-1.08 2.42-2.42v-.01c0-.95-.56-1.82-1.44-2.21M15 20H9v-5h6zm3.58-6H17v-1H7v1H5.42c-.46 0-.58-.65-.17-.81l6.75-3l6.75 3c.42.19.28.81-.17.81"/></svg>

            <span class="mx-3">Maintenances</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
            href="{{ route('custom-orders.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><path fill="currentColor" d="M11.5 4a3.5 3.5 0 1 0 0 7a3.5 3.5 0 0 0 0-7M6 7.5a5.5 5.5 0 1 1 11 0a5.5 5.5 0 0 1-11 0m8.382 6h7.236l2.081 4.162L18 23.995l-5.7-6.333zm1.236 2l-.919 1.838L18 21.005l3.3-3.667l-.918-1.838zM8 16a4 4 0 0 0-4 4h7.05v2H2v-2a6 6 0 0 1 6-6h3v2z"/></svg>

            <span class="mx-3">Custom Orders</span>
        </a>

       

        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
            href="{{ route('faqs.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><path fill="currentColor" d="M18 15H6l-4 4V3a1 1 0 0 1 1-1h15a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1m5-6v14l-4-4H8a1 1 0 0 1-1-1v-1h14V8h1a1 1 0 0 1 1 1M8.19 4c-.87 0-1.57.2-2.11.59c-.52.41-.78.98-.77 1.77l.01.03h1.93c.01-.3.1-.53.28-.69a1 1 0 0 1 .66-.23c.31 0 .57.1.75.28c.18.19.26.45.26.75c0 .32-.07.59-.23.82c-.14.23-.35.43-.61.59c-.51.34-.86.64-1.05.91C7.11 9.08 7 9.5 7 10h2c0-.31.04-.56.13-.74c.09-.18.26-.36.51-.52c.45-.24.82-.53 1.11-.93c.29-.4.44-.81.44-1.31c0-.76-.27-1.37-.81-1.82C9.85 4.23 9.12 4 8.19 4M7 11v2h2v-2zm6 2h2v-2h-2zm0-9v6h2V4z"/></svg>

            <span class="mx-3">FAQ</span>
        </a>

<a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
href="{{ route('questions.index') }}">

<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 16 16"><path fill="currentColor" d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25c.09-.656.54-1.134 1.342-1.134c.686 0 1.314.343 1.314 1.168c0 .635-.374.927-.965 1.371c-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486c.609-.463 1.244-.977 1.244-2.056c0-1.511-1.276-2.241-2.673-2.241c-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927c.609 0 1.028-.394 1.028-.927c0-.552-.42-.94-1.029-.94c-.584 0-1.009.388-1.009.94"/></svg>
 <span class="mx-3">Questions</span>
</a>

        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
            href="{{ route('coupons.index') }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"><path fill="currentColor" d="M14.8 8L16 9.2L9.2 16L8 14.8zM4 4h16c1.11 0 2 .89 2 2v4a2 2 0 1 0 0 4v4c0 1.11-.89 2-2 2H4a2 2 0 0 1-2-2v-4c1.11 0 2-.89 2-2a2 2 0 0 0-2-2V6a2 2 0 0 1 2-2m0 2v2.54a3.994 3.994 0 0 1 0 6.92V18h16v-2.54a3.994 3.994 0 0 1 0-6.92V6zm5.5 2c.83 0 1.5.67 1.5 1.5S10.33 11 9.5 11S8 10.33 8 9.5S8.67 8 9.5 8m5 5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5s-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5"/></svg>

            <span class="mx-3">Coupons</span>
        </a>

        <a class="flex items-center px-6 py-2 mt-4 text-gray-500 hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100"
       
        href="{{ route('gift-cards.index') }}">
       <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 56 56"><path fill="currentColor" d="M46.593 9c2.292 0 4.011.57 5.158 1.708c1.086 1.08 1.657 2.656 1.714 4.731l.005.35v23.852c0 2.249-.573 3.939-1.72 5.07c-1.085 1.073-2.685 1.637-4.8 1.693l-.357.005H8.877c-2.292 0-4.011-.566-5.158-1.697c-1.086-1.073-1.657-2.646-1.714-4.72L2 39.642V15.79c0-2.264.573-3.961 1.72-5.093c1.085-1.072 2.685-1.636 4.8-1.692L8.877 9zM5.526 39.444c0 1.139.292 1.997.876 2.574c.54.532 1.296.819 2.27.86l.25.005l17.477-.001V31.275h-.153c-.365 1.124-.938 2.197-1.72 3.22a16.477 16.477 0 0 1-2.672 2.759a16.68 16.68 0 0 1-3.044 2.004c-1.03.518-1.96.843-2.793.975c-.627.087-1.12-.052-1.478-.417c-.358-.365-.537-.788-.537-1.27c0-.526.154-.953.46-1.281c.269-.288.632-.472 1.09-.552l.203-.029c.759-.087 1.57-.368 2.43-.843a14.973 14.973 0 0 0 2.509-1.752a18.031 18.031 0 0 0 2.168-2.19c.556-.671.991-1.305 1.307-1.904l.127-.254H5.526zm44.417-9.703h-18.77c.322.672.8 1.391 1.435 2.158a18.027 18.027 0 0 0 2.169 2.19c.81.694 1.642 1.278 2.496 1.752c.76.422 1.482.69 2.166.807l.255.036c.57.059 1.007.252 1.314.58c.306.33.46.756.46 1.282c0 .482-.18.905-.537 1.27c-.358.365-.85.504-1.478.417c-.847-.132-1.782-.457-2.804-.975a16.86 16.86 0 0 1-3.033-2.004c-1-.818-1.891-1.738-2.672-2.76a10.912 10.912 0 0 1-1.59-2.847l-.13-.372h-.175v11.607h17.5c1.08 0 1.916-.288 2.508-.864c.546-.533.84-1.305.882-2.316l.005-.258zm-3.149-17.21l-.245-.005h-17.5v7.513a9.354 9.354 0 0 1 1.763-2.42a7.659 7.659 0 0 1 2.29-1.566a6.421 6.421 0 0 1 2.605-.548c1.577 0 2.888.522 3.932 1.566s1.566 2.37 1.566 3.975c0 .92-.197 1.778-.591 2.574a6.991 6.991 0 0 1-1.654 2.135a9.592 9.592 0 0 1-2.119 1.414l-.345.163h13.447V15.987c0-1.14-.295-2-.886-2.585c-.546-.539-1.3-.83-2.263-.87M26.4 12.526H8.921c-1.095 0-1.935.292-2.519.876c-.539.54-.83 1.315-.87 2.327l-.006.258v11.345h13.426a9.88 9.88 0 0 1-2.442-1.577a7.144 7.144 0 0 1-1.664-2.135a5.632 5.632 0 0 1-.603-2.574c0-1.606.526-2.931 1.577-3.975c1.052-1.044 2.358-1.566 3.92-1.566c.92 0 1.797.182 2.629.548a7.66 7.66 0 0 1 2.289 1.566a8.826 8.826 0 0 1 1.56 2.075l.181.345zm-6.483 6.089c-.788 0-1.416.237-1.884.712c-.467.474-.7 1.128-.7 1.96c0 .686.211 1.369.635 2.048c.423.679 1.007 1.292 1.752 1.84a9.66 9.66 0 0 0 2.56 1.325a9.156 9.156 0 0 0 2.664.496l.403.008h.657v-.614a9.1 9.1 0 0 0-.482-2.978a8.383 8.383 0 0 0-1.336-2.486c-.57-.723-1.22-1.289-1.95-1.698a4.68 4.68 0 0 0-2.321-.613m15.616 0a4.64 4.64 0 0 0-2.3.613c-.73.41-1.38.975-1.949 1.698a8.578 8.578 0 0 0-1.347 2.486a8.807 8.807 0 0 0-.485 2.587l-.008.391v.614h.658a9.319 9.319 0 0 0 3.088-.504a9.479 9.479 0 0 0 2.551-1.325c.738-.548 1.318-1.161 1.742-1.84c.423-.679.635-1.362.635-2.048c0-.832-.23-1.486-.69-1.96c-.46-.475-1.092-.712-1.895-.712"/></svg>

        <span class="mx-3">Gift Cards</span>
    </a>
    </nav>
</div>
