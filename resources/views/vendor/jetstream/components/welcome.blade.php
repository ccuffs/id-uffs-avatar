<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    <div class="mt-8 text-2xl">
        Imagem de perfil
    </div>

    <div class="mt-6 text-gray-500">
        Esse serviço permite que você consulte como é a sua imagem de peril em vários sistemas online parceiros da UFFS. Veja abaixo qual é a imagem mais recente que temos de você.
    </div>

    <div class="mt-6 text-gray-400 text-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <strong>Importante:</strong> essa imagem foi obtida de forma automática dos registros da UFFS a partir do seu cartão da UFFS (sistema <a href="https://sci.uffs.edu.br/">SCI</a>).
    </div>    
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
    <div class="p-6">

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                <img src="{{ auth()->user()->sci_photo_url }}" />
            </div>

            <a href="https://sci.uffs.edu.br">
                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                    <div>Obtido de https://sci.uffs.edu.br</div>
                </div>
            </a>
        </div>
    </div>

    <div class="p-6">
        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                <strong>Exemplos</strong>
            </div>

            <div class="mt-2 text-sm text-gray-500">
                Confira abaixo alguns exemplos de como você aparecerá nos vários sistemas parceiros:
            </div>

            <div class="mt-4 text-sm text-gray-500">
                <div class="flex items-center">
                    <img class="h-12 w-12 rounded-full" src="{{ auth()->user()->sci_photo_url }}"/>
                    <div class="ml-2">
                      <div class="text-sm ">
                        <span class="font-semibold">{{ auth()->user()->name }}</span>
                        <span class="text-gray-500"></span>
                      </div>
                      <div class="text-gray-500 text-xs ">{{ auth()->user()->uid }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-4 text-sm text-gray-500">
                <img class="inline object-cover w-16 h-16 mr-2" src="https://images.pexels.com/photos/2589653/pexels-photo-2589653.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" alt="Profile image"/>
            </div>

            <div class="mt-4 text-sm text-gray-500">
                <div class="relative inline-block">
                    <img class="inline-block object-cover w-12 h-12 rounded-full" src="https://images.pexels.com/photos/2955305/pexels-photo-2955305.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" alt="Profile image"/>
                    <span class="absolute bottom-0 right-0 inline-block w-3 h-3 bg-green-600 border-2 border-white rounded-full"></span>
                </div>
            </div>
        </div>
    </div>
</div>
