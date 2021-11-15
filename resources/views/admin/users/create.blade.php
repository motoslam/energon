<x-admin-layout title="Создание пользователя">

    <div class="app">
        <h4 class="mb-4">
            <a href="{{ route('admin.users.index') }}">Пользователи</a> / Создать пользователя
        </h4>

        <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">

            @csrf

            <div class="mb-3 row">
                <label for="userName" class="col-sm-2 col-form-label">Имя пользователя:</label>
                <div class="col-sm-5 ">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="userName"
                           name="name" required value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="userEmail" class="col-sm-2 col-form-label">Адрес эл. почты:</label>
                <div class="col-sm-5">
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="userEmail" name="email" required  value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="userPhoto" class="col-sm-2 col-form-label">Фото профиля:</label>
                <div class="col-sm-4">
                    <input type="file" class="form-control" id="userPhoto" name="photo">
                    @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="userRole" class="col-sm-2 col-form-label">Роль пользователя:</label>
                <div class="col-sm-3">
                    <select name="role_id" id="userRole" class="form-select @error('role_id') is-invalid @enderror">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="userPassword" class="col-sm-2 col-form-label">Пароль:</label>
                <div class="col-sm-3">
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           id="userPassword" name="password" autocomplete="new-password" required>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-2">
                    <button type="button" onclick="putPassword('#userPassword', '#userPasswordConfirm')"
                            class="btn btn-outline-primary">
                        Сгенерировать
                    </button>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="userPasswordConfirm" class="col-sm-2 col-form-label">Подтверждение пароля:</label>
                <div class="col-sm-3">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                           id="userPasswordConfirm" name="password_confirmation" required autocomplete="off">
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <div class="col-sm-2">&nbsp;</div>
                <div class="col-sm-5">
                    <div class="form-check ">
                        <input class="form-check-input" type="checkbox" name="send_email" id="sendEmail" checked>
                        <label class="form-check-label" for="sendEmail">
                            Отправить данные для входа на электронную почту
                        </label>
                    </div>
                </div>
            </div>


            <div class="button-block">
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Добавить пользователя</button>
                </div>
            </div>

        </form>

    </div>

</x-admin-layout>
