<x-app-layout>
    <form action="/admin/upload-images" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" required>
        <button type="submit">Upload</button>
    </form>
</x-app-layout>
