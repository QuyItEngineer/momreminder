<template>
    <div class="record-container text-center">
        <div class="col-sm-12 ">
            <span class="fa-stack fa-4x m-auto">
              <i class="fa fa-circle fa-stack-2x icon-background-red"></i>
              <i class="fa fa-microphone fa-stack-1x icon-background-white"></i>
            </span>
        </div>
        <div class="col-sm-12" v-show="!isRecorded">
            <span class="timer">{{recordingMinutes}}<small>m</small> {{recordingSeconds}}<small>s</small></span>
        </div>
        <div class="col-sm-12" v-show="isRecorded">
            <audio controls v-bind:src="audioUrl">
            </audio>
            <input type="hidden" :name="name" v-model="recordUploadedLink">
        </div>
        <div class="col-sm-12">
            <button @click="startRecord" :class="{recording: isRecording, shadow: !isRecording}" type="button"
                    class="btn-record"
                    v-show="!isRecording"></button>
            <button @click="stopRecord" :class="{recording: isRecording, shadow: !isRecording}" type="button"
                    class="btn-record"
                    v-show="isRecording"></button>
        </div>
        <div class="col-sm-12">
            <b>Tap to Record</b>
        </div>
    </div>
</template>

<script>
    import Microm from 'microm';

    export default {
        name: "AudioRecord",
        props: {
            name: String,
            value: {
                type: String,
                default: ''
            },
            uploadUrl: String
        },
        data() {
            return {
                audioBlob: null,
                audioUrl: null,
                isRecording: false,
                recordingTime: 0,
                recordingTimer: null,
                recordUploadedLink: null,
                microm: new Microm()
            }
        },
        mounted() {
            this.recordUploadedLink = this.value;
        },
        methods: {
            startRecord() {
                this.audioUrl = null;
                this.audioBlob = null;
                this.microm.record().then(() => {
                    this.isRecording = true;
                    this.recordingTime = 0;
                    this.recordingTimer = setInterval(() => {
                        this.recordingTime++
                    }, 1000)
                }).catch((error) => {
                    console.log('error recording', error);
                });
            },
            stopRecord() {
                this.microm.stop().then((result) => {
                    this.isRecording = false;
                    this.audioUrl = result.url;
                    this.audioBlob = result.blob;
                    console.log('wav', this.microm.getWav());
                    this.upload();
                });
                if (this.recordingTimer) {
                    clearInterval(this.recordingTimer)
                }
            },
            playRecord() {
                this.audioUrl = URL.createObjectURL(this.audioBlob);
                const audio = new Audio(this.audioUrl);
                audio.play();
            },
            upload() {
                let formData = new FormData();
                console.log(this.audioBlob);
                formData.append('record_file', this.audioBlob, 'record.wav');

                axios.post(this.uploadUrl,
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then((res) => {
                    this.recordUploadedLink = res.data;
                    this.$toasted.success('File upload completed')
                }).catch(() => {
                    this.$toasted.error('File upload error');
                });
            }
        },
        computed: {
            recordingMinutes() {
                let result = parseInt(this.recordingTime / 60);
                if (result < 10) {
                    return '0' + result;
                }
                return result;
            },
            recordingSeconds() {
                let result = this.recordingTime % 60;
                if (result < 10) {
                    return '0' + result;
                }
                return result;
            },
            isRecorded() {
                return !this.isRecording && this.audioUrl !== null && this.audioUrl !== undefined
            }
        }
    }
</script>

<style scoped lang="scss">
    .record-container {
        display: block;

        .icon-background-red {
            color: #E16762;
        }

        .icon-background-white {
            color: #fff
        }

        .btn-record {
            width: 35px;
            height: 35px;
            font-size: 0;
            background-color: #E16762;
            border-radius: 35px;
            margin: 18px;
            outline: none;
            border: 3px solid #fff;
        }

        .recording {
            animation-name: pulse;
            animation-duration: 1.5s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        .shadow {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .timer {
            font-family: Roboto, serif;
            font-size: 30px;
            small {
                font-size: 10px;
            }
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 5px 0 rgba(173, 0, 0, .3);
            }
            65% {
                box-shadow: 0 0 5px 13px rgba(173, 0, 0, .3);
            }
            90% {
                box-shadow: 0 0 5px 13px rgba(173, 0, 0, 0);
            }
        }

    }
</style>