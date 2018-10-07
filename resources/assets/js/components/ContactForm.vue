<template>
    <div>
        <div class="col-md-12">
            <div data-repeater-list="contact" v-for="(item, index) in items">
                <div data-repeater-item class="mt-repeater-item row">
                    <div class="mt-repeater-input col-md-2">
                        <label class="control-label">Name: </label>
                        <input type="text" class="form-control" :name="getContactFormName('name',index)"
                               v-model="item.name" required>
                    </div>
                    <div class="mt-repeater-input col-md-3">
                        <label class="control-label">Phone: <span class="required"> * </span> (Ex: xxx-xxx-xxxx)
                        </label>
                        <input type="text" class="form-control bfh-phone" :name="getContactFormName('phone',index)"
                               v-model="item.phone" data-format="ddd-ddd-dddd" required>
                    </div>
                    <div class="mt-repeater-input col-md-2">
                        <label class="control-label">Email: </label>
                        <input type="email" class="form-control" :name="getContactFormName('email',index)"
                               v-model="item.email">
                    </div>
                    <div class="mt-repeater-input col-md-2">
                        <label class="control-label">Birthday: </label>
                        <input type="date" class="form-control bfh-day" :name="getContactFormName('birthday',index)"
                               v-model="item.birthday">
                    </div>
                    <div class="mt-repeater-input col-md-2">
                        <label class="control-label">Member: </label>
                        <select :name="getContactFormName('member',index)" v-model="item.member" class="form-control">
                            <option value="0">Member</option>
                            <option value="1">Non-member</option>
                        </select>
                    </div>
                    <div class="mt-repeater-input col-md-1">
                        <label class="control-label">&nbsp;</label>
                        <a href="javascript:;" data-repeater-delete @click="deleteContact(index)" class="btn btn-block btn-danger mt-repeater-delete">
                            <i class="fa fa-close"></i></a>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="row">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                    <label class="control-label">&nbsp;</label>
                    <a href="javascript:;" id="close-form" @click="addNewContact" data-repeater-create
                       class="btn btn-block btn-success mt-repeater-add"><i class="fa fa-plus"></i> ADD </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ContractForm",
        data() {
            return {
                items: [{
                    name: '',
                    phone: '',
                    email: '',
                    birthday: '',
                    member: ''
                }]
            }
        },
        methods: {
            addNewContact() {
                this.items.push({
                    name: '',
                    phone: '',
                    email: '',
                    birthday: '',
                    member: ''
                })
            },
            deleteContact(index) {
                this.items.splice(index, 1);
            },
            getContactFormName(fieldName, index) {
                return `contacts[${index}][${fieldName}]`;
            }
        }
    }
</script>

<style scoped>
    .required {
        color: #e02222;
        font-size: 12px;
        padding-left: 2px;
    }
</style>