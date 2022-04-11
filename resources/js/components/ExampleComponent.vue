<script>
import StationSearchField from './StationSearchField.vue';

export default {
    components: { StationSearchField }
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
                            <station-search-field></station-search-field>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </v-app>
</template>
