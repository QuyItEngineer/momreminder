<template>
    <div>
        <div class="form-group col-md-6">
            <audio-record name="record_file" @on-completed="onRecordCompleted"></audio-record>
        </div>
        <div class="form-group col-md-6">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" v-model="model.name"/>
        </div>
        <div class="form-group col-md-6">
            <label for="status">Status</label>
            <input type="text" id="status" name="status" class="form-control"/>
        </div>
        <div class="form-group col-md-6">
            <button type="submit" class="btn btn-primary" @submit.prevent="submit">Save</button>
        </div>
    </div>
</template>

<script>
    import AudioRecord from './AudioRecord'

    export default {
        name: "RecordForm",
        components: {
            AudioRecord
        },
        props: {
            value: {
                type: Object,
                default: () => {
                    return {
                        name: '',
                        status: 0
                    }
                }
            }
        },
        data() {
            return {
                model: {}
            }
        },
        mounted() {
            this.model = this.value
        },
        methods: {
            onRecordCompleted({url, blob}) {
                console.log(url)
            },
            submit(e) {
                console.log('submit', e)
            }
        }
    }
</script>

<style scoped>

</style>