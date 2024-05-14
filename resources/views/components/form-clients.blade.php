@props(['action', 'method' => 'POST', 'company'])

<form method="{{ $method }}" action="{{ $action }}" onsubmit="return validateForm()">
    @csrf
    <div class="py-7">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap">
                <!-- Card Company -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-2/3">
                    <x-card>
                        <x-slot name="header">
                            <section class="flex justify-between items-center">
                                <h2 class="font-extrabold text-lg text-blue-950">
                                    {{ __('Company') }}
                                </h2>
                                <a class="mx-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition ease-in-out duration-200"
                                    href="javascript:;" id="search-button">
                                    <i class="fa-solid fa-magnifying-glass ml-4 my-2"></i>
                                    <span class="m-4">{{ __('Search') }}</span>
                                </a>
                            </section>
                        </x-slot>

                        <x-slot name="body">
                            <div class="mx-2">
                                <!-- Campo id -->
                                <input id="empresa_id" name="empresa_id" value="{{ $company->id ?? '' }}" hidden />
                                <!-- Campo CIF -->
                                <div class="mb-4">
                                    <x-label for="cif" :value="__('CIF')" />
                                    <x-input id="cif" type="text" name="cif" class="block w-full"
                                        value="{{ $company->cif ?? old('cif') }}" required />
                                    <p class="text-red-600 hidden" id="cifError">
                                        {{ __('CIF') . ' ' . __('is requied.') }}</p>
                                    @error('cif')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo Nombre -->
                                <div class="mb-4">
                                    <x-label for="nombre" :value="__('Name')" />
                                    <!-- Ejemplo con el campo de nombre -->
                                    <x-input id="nombre" type="text" name="nombre" class="block w-full"
                                        value="{{ $company->nombre ?? old('nombre')  }}" required />

                                    <p class="text-red-600 hidden" id="nombreError">
                                        {{ __('Name') . ' ' . __('is required.') }}</p>
                                    @error('nombre')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo Domicilio (Text Area) -->
                                <div class="mb-4">
                                    <x-label for="domicilio" :value="__('Address')" />
                                    <textarea id="domicilio" name="domicilio" rows="4"
                                        class="block w-full border border-gray-300 p-2 rounded-lg focus:outline-none focus:ring focus:border-blue-300 transition"
                                        required>{{ $company->domicilio ?? old('domicilio') }}</textarea>
                                    @error('domicilio')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo Teléfono -->
                                <div class="mb-4">
                                    <x-label for="telefono" :value="__('Phone')" />
                                    <x-input id="telefono" type="tel" name="telefono"
                                        class="block w-full" value="{{ $company->telefono ?? old('telefono') }}" required />
                                    @error('telefono')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo Email -->
                                <div class="mb-4">
                                    <x-label for="email" :value="__('Email')" />
                                    <x-input id="email" type="email" name="email"
                                        class="block w-full" value="{{ $company->email ?? old('email') }}" required />
                                    <p class="text-red-600 hidden" id="emailError">
                                        {{ __('Email') . ' ' . __('is required.') }}</p>
                                    @error('email')
                                        <span class="text-red-600">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo Web -->
                                <div class="mb-4">
                                    <x-label for="web" :value="__('Website')" />
                                    <x-input id="web" type="url" name="web"
                                        value="{{ $company->web ?? old('web') }}" class="block w-full" />
                                </div>
                            </div>
                        </x-slot>
                    </x-card>
                </div>

                <!-- Card Client -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:w-1/3">
                    <x-card>
                        <x-slot name="header">
                            <h2 class="font-extrabold text-lg text-blue-950">
                                {{ __('Client') }}
                            </h2>
                        </x-slot>

                        <x-slot name="body">
                            <!-- Campo Name -->
                            <div class="mb-4">
                                <x-label for="client_name" :value="__('Name')" />
                                <x-input id="client_name" type="text" name="client_name" :value="old('client_name')"
                                    class="block w-full" required />
                                @error('client_name')
                                    <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Campo Email -->
                            <div class="mb-4">
                                <x-label for="client_email" :value="__('Email')" />
                                <x-input id="client_email" type="email" name="client_email" :value="old('client_email')"
                                    class="block w-full" required />
                                @error('client_email')
                                    <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </x-slot>
                    </x-card>
                </div>
            </div>
        </div>
    </div>

    <div class="relative">
        <button
            class="fixed bottom-8 right-8 bg-green-600 text-white rounded-full hover:bg-green-700 transition ease-in-out duration-200 p-4 group"
            type="submit">
            <i class="fa-solid fa-floppy-disk fa-2x"></i>
        </button>
    </div>
</form>
