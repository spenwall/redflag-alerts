<template>
    <form method="POST" action="/alerts">
        <input type="hidden" name="_token" :value="csrf">
        <div class="form-group">
                <label for="name">Alert Name</label>
                <input type="text" class="form-control" id="name" 
                        name="name" placeholder="Alert Name" required>
        </div>

        <div class="form-group">
                <label for="keywords">Search Keywords</label>
                <input type="text" class="form-control" id="keywords" 
                        name="keywords" placeholder="Search Keywords" required>
        </div>
        
        <button type="submit" class="btn btn-primary float-right">Submit</button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }
}
</script>
