<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <form wire:submit.prevent="submit" class="form-message" id="message-form" x-data>
        <label class="add-files">
            <input type="file">
            <span></span>
        </label>

        <textarea name="message" placeholder="Напишите комментарий..."
                  wire:model.defer="body" @keydown.enter="$refs.btn.click()"></textarea>
        <button class="send-message" type="submit" x-ref="btn"></button>
        <button class="send-message send-message-loading" type="button" wire:loading></button>
    </form>
</div>
