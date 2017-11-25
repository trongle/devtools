<template>
    <div class="container">
        <div class="row">
            <div class="title">
                <h1>Convert unix timestamp</h1>
            </div>
            <div class="content">

                <div v-if="showCustomizeForm" class="result customize-form">
                    <form  @submit.prevent>
                        <div class="form-input">
                            <label>Format: </label>
                            <select v-model="customize.format" class="selectBox">
                                <option v-for="opt in formatOptions"
                                        :value="opt.val">
                                    {{ opt.name }}
                                </option>
                            </select>
                        </div>
                        <div class="form-input">
                            <label>City: </label>
                            <select v-model="customize.timezone" class="selectBox">
                                <option v-for="opt in timezoneOptions"
                                        :value="opt">
                                    {{ opt }}
                                </option>
                            </select>
                        </div>
                    </form>

                    <!-- <span class="text-error" v-show="errors.has('timestamp')">{{ errors.first('timestamp') }}</span> -->
                </div>

                <div  v-if="!showCustomizeForm" class="convert-form">
                    <form  @submit.prevent :class="{'shadow-box' : true, 'is-error': errors.has('timestamp')}">
                        <input  v-validate="'required|numeric'"
                                autocomplete="off"
                                type="text"
                                name="timestamp"
                                @keyup.enter="convert"
                                v-model="timestamp"
                                :class="{'convert-input-text' : true, 'input-error': errors.has('timestamp')}">

                        <button type="button"
                                @click="convert"
                                :class="{'convert-button' : true, 'btn-error': errors.has('timestamp')}">
                            <img v-if="loading" class="loading" src="/images/loading.svg">
                            <span v-else>convert</span>
                        </button>
                    </form>
                    <!-- <span class="text-error" v-show="errors.has('timestamp')">{{ errors.first('timestamp') }}</span> -->
                </div>

                <div class="result" v-if="!showCustomizeForm">
                    <ul>
                        <li>In your local time zone: <b class="result-date">{{ results.date }}</b></li>
                    </ul>
                </div>

                <a v-if="!showCustomizeForm" href="#" @click="triggerCustomizeForm" class="customize-text">&raquo; customize time zone and format</a>
                <a v-else href="#" @click.prevent="saveCustomize" class="customize-text">&raquo; save your customize</a>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.loading {
    width: 35%;
    vertical-align: middle;
}

.selectBox {
    width: 75%;
    height: 30px;
}

.container {
    margin-top: 100px;
    font-size: 20px;

    .is-error {
        border: 2px solid red !important;
    }

    .text-error,
    .input-error {
        color: red !important;
    }

    .btn-error {
        background: red !important;
    }

    .row {
        background: white;
        padding: 20px;
        width: 765px;
        margin: 0 auto;
        posotion: relative;
        padding: 20px 20px 35px 20px;

        .title {
            text-align: center;
        }

        .content {

            .convert-form,
            .customize-form {
                .form-input {
                    margin: 15px;

                    label {
                        color: #333;
                        width: 80px;
                        text-align: right;
                        clear: both;
                        float:left;
                        margin-right:15px;
                    }
                }
                .shadow-box {
                    position: relative;
                    border: 2px solid #76ff03;
                    background: #fff;
                    height: 59px;
                    clear: both;
                    margin-bottom: 5px;

                    .convert-input-text {
                        float: left;
                        width: 505px;
                        height: 55px;
                        border: none;
                        background: #fff;
                        color: #76ff03;
                        text-align: center;
                        display: block;
                        line-height: 58px;
                        font-size: 27px;
                        font-family: 'Lato', sans-serif;

                        &:focus {
                            outline: none
                        }
                    }

                    .convert-button {
                        position: absolute;
                        top: 0;
                        right: 0;
                        float: right;
                        height: 55px;
                        background: #76ff03;
                        color: #fff;
                        border: none;
                        display: block;
                        margin: 0;
                        line-height: 55px;
                        font-size: 27px;
                        font-family: 'Lato', sans-serif;
                        width: 125px;

                        &:focus {
                            outline: none
                        }

                        &:hover {
                            cursor: pointer;
                            background: #32cb00;
                        }
                    }
                }
            }

            .result {
                border: 2px solid #76ff03;
                background: #fff;
                padding: 5px;
                margin-top: 20px;
                color: #333;

                .result-date {
                    color: #76ff03;
                }
            }

            .customize-text {
                float: right;
                color: #ef5350;
                margin: 5px 0;
                font-weight: bold;
            }
        }
    }
}

</style>

<script>
    import { customize } from '../../store/timestamp';
    import _ from 'lodash';

    export default {
        mounted(){

        },
        data() {
            return {
                timestamp: '',
                results: {
                    date: ''
                },
                error: false,
                loading: false,
                showCustomizeForm: false,
                customize: {
                    format: 'default',
                    timezone: 'UTC'
                }
            }
        },
        methods: {
            convert(){
                this.$validator.validateAll().then(result => {

                    if(!this.loading && result){
                        //valid
                        this.loading = true;

                        axios.post('/api/timestamp', { timestamp: this.timestamp })
                            .then(res => {
                                this.loading = false;
                                var data = res.data;
                                this.results.date = data.date;
                            })
                    }

                    //invalid
                });
            },
            saveCustomize(){
                if(this.customize.format && this.customize.timezone){

                    axios.post('api/timestamp/customize', { customize : this.customize, timestamp: this.timestamp })
                        .then(res => {
                            var data = res.data;

                            this.results.date = data.date;

                            this.showCustomizeForm = false;
                        })
                }
            },
            triggerCustomizeForm(){
                this.showCustomizeForm = !this.showCustomizeForm;
            },
        },
        computed: {
            formatOptions(){
                return customize.formats;
            },
            timezoneOptions(){
                return customize.timezones;
            }
        }
    }
</script>
