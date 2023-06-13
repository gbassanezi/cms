<div class="divide-y divide-gray-800" x-data="{ show: false }">
    <nav class="flex items-center px-3 py-2 bg-gray-900 shadow-lg">
        <div>
            <button @click="show =! show" class="items-center block h-8 mr-3 text-white hover:text-gray-200 focus:text-gray-200 focus:outline-none sm:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-align-justified" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M4 6l16 0" />
                    <path d="M4 12l16 0" />
                    <path d="M4 18l12 0" />
                </svg>
            </button>
        </div>
        <div class="flex items-center w-full h-12 ">
            <a href="{{ url('/')}}" class="w-full">
                <x-application-mark class="block w-auto h-9" />
            </a>
        </div>
        <div class="flex justify-end sm:w-8/12">
            {{-- Top Navigation --}}
            <ul class="hidden text-xs text-white sm:flex sm:text-left">
                @foreach ($topNavLinks as $item)
                    <a href="{{ url('/'.$item->slug) }}">
                        <li class="px-4 py-2 cursor-pointer hover:bg-gray-800">{{ $item->label }}</li>
                    </a>
                @endforeach
            </ul>
        </div>
    </nav>
    <div class="sm:flex sm:min-h-screen">
        <aside class="text-gray-700 bg-gray-900 divide-y divide-gray-700 divide-dashed sm:w-4/12 md:w-3/12 lg:w-2/12">
            {{-- Desktop Web View --}}
            <ul class="hidden text-xs text-white sm:block sm:text-left">
                @foreach ($sideBarLinks as $item)
                    <a href="{{ url('/'.$item->slug) }}">
                        <li class="px-4 py-2 border cursor-pointer hover:bg-gray-800">{{ $item->label }}</li>
                    </a>
                @endforeach
            </ul>

            {{-- Mobile Web View --}}
            <div :class="show ? 'block' : 'hidden'" class="block pb-3 divide-y divide-gray-800 sm:hidden">
                <ul class="text-xs text-white">
                    @foreach ($sideBarLinks as $item)
                        <a href="{{ url('/'.$item->slug) }}">
                            <li class="px-4 py-2 cursor-pointer hover:bg-gray-800">{{ $item->label }}</li>
                        </a>
                    @endforeach
                </ul>

                {{-- Top Navigation Mobile Web View --}}
                <ul class="text-xs text-white">
                    @foreach ($topNavLinks as $item)
                        <a href="{{ url('/'.$item->slug) }}">
                            <li class="px-4 py-2 cursor-pointer hover:bg-gray-800">{{ $item->label }}</li>
                        </a>
                    @endforeach
                </ul>
            </div>
        </aside>
        <main class="min-h-screen p-12 bg-gray-100 sm:w-8/12 md:w-9/12 lg:w-10/12">
            <section class="text-gray-900 divide-y">
                <h1 class="text-3xl font-bold text-center">{{ $title }}</h1>
                <article>
                    <div class="mt-5 text-sm">
                        {!! $content !!}
                    </div>
                </article>
            </section>
        </main>
    </div>
</div>
