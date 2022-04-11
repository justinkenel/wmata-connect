<script>
export default {
    data: () => ({
        values:[],
        items:[],

        stations: [],
        loading: true,
        error: null
    }),

    mounted() {
        axios.get('/api/station')
            .then(response => {
                this.stations = response.data.Stations;
                this.loading = false;

                this.items = this.stations.map(x => ({
                    text: x.Name,
                    value: x.Code
                }));
                // this.values = this.stations.map(x => x.Code);

                console.log('loaded', this);
            })
            .catch(e => this.error = e);
    }
}
</script>

<template>
    <v-card>
        <v-container fluid>
        <v-row
            align="center"
        >
            <v-col cols="12">
                <div v-if="loading">Loading Station List</div>
                <v-autocomplete
                    v-if="!loading"
                    :items="items"
                    outlined
                    dense
                    chips
                    small-chips
                    label="Select Station"
                ></v-autocomplete>
            </v-col>
        </v-row>
        </v-container>
    </v-card>
</template>
