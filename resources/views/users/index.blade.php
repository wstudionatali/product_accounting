<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table">
                      <thead>
                        <tr>
                           <th>ID</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Role</th>
                           <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach ($users as $user)
                         <tr>
                           <td>{{ $user->id }}</td>
                           <td>{{ $user->name }}</td>
                           <td>{{ $user->email }}</td>
                           <td>
                             <form method="POST" action="{{ route('users.update', $user) }}">
                                @csrf
                                @method('PUT')
                                <select name="role" onchange="this.form.submit();">
                                    <option value="">{{ __('Chose role') }}</option>
                                     @foreach ($roles as $role)

                                       <option value="{{ $role->id  }}"
                                        @if (!is_null($user->userRole))
                                           {{  $user->userRole->role === $role->role ? 'selected' : '' }}
                                        @endif
                                        >{{ $role->role}}</option>
                                     @endforeach
                                </select>
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                              </form>
                            </td>
                            <td>
                                <form action="{{ route('users.destroy', $user) }}" method="POST">
                                 @csrf
                                 @method('DELETE')
                                 <button class="rounded-md border border-slate-300 bg-white px-5 py-2 text-center text-sm font-semibold text-black shadow-sm hover:bg-slate-900">Delete</button>
                                </form>
                            </td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
