<template>
    <div class="form-group col-sm-12">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="contact in contactModels">
                <td><input type="text" class="full-width table-group" v-model="contact.name" @blur="updateData(contact.id, contact)"></td>
                <td><input type="text" class="full-width table-group" v-model="contact.phone" @blur="updateData(contact.id, contact)"></td>
                <td><input type="text" class="full-width table-group" v-model="contact.email" @blur="updateData(contact.id, contact)"></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "ListContactEditable",
        props: {
            contacts : {
                type : Array,
                default: () => [],
            }
        },
        data() {
            return {
                contactModels: []
            }
        },
        mounted() {
            this.contactModels = this.contacts;
        },
        methods : {
            updateData(id, contact) {
                axios.put('/api/contacts/'+id, contact)
                    .then((res) => {
                        this.$toasted.success(res.data.message)
                    })
                    .catch((err) => {
                        this.$toasted.error(err.toString())
                    });
            }
        }
    }
</script>

<style scoped>
    input.full-width.table-group {
        width:  100%;
        border: 1px solid #ccd0d2;
        border-radius: 4px;
    }
</style>