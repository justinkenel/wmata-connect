<script>
import StationSearchField from './StationSearchField.vue';
import NextTrainList from './NextTrainList.vue';

export default {
    components: { StationSearchField, NextTrainList },

    data() {
        return {
            stationInfo: {},

            onStationSelect: (station) => {
                console.log('loading station data', station);
                axios.get('/api/station/'+station)
                    .then(response => {
                        this.stationInfo = {
                            trains: response.data.Trains
                        };
                        console.log('loaded', this);
                    })
                    .catch(e => this.error = e);
            }
        };
    }
}
</script>

<template>
    <v-app>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Wmata Connect</div>
                        <div class="card-body">
                            <station-search-field @change="onStationSelect"></station-search-field>
                        </div>
                        <div>
                            <next-train-list :trainList="stationInfo.trains"></next-train-list>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </v-app>
</template>
