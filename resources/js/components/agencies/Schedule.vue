<template>
    <div>
        <h5 v-if="employee.first_name && employee.last_name" class="mb-3"> <i class="mdi mdi-account ml-1"></i> {{`${employee.first_name} ${employee.last_name}`}} </h5>
        <div class="schedule" v-for="day, dayNumber in weekDays">
            <div class="bg-info text-light">
                {{day}}
            </div>
            <div v-for="range in dayHours" @click="setHour(dayNumber, range, index)" :class="hoursList.includes(`${dayNumber},${range}`) ? 'bg-success text-light' : ''">
                {{range}}
            </div>
        </div>
        <div class="text-center mt-2">
            <button type="button" class="btn btn-primary" @click="updateSchedule"> <i class="mdi mdi-check ml-1"></i> {{fa.CONFIRM}} </button>
        </div>
    </div>
</template>

<script>
export default {
    props : ['fa', 'employee', 'agency', 'index'],
    data() {
        return {
            weekDays : [this.fa.SATURDAY, this.fa.SUNDAY, this.fa.MONDAY, this.fa.TUESDAY, this.fa.WEDNESDAY, this.fa.THRSDAY, this.fa.FRIDAY],
            dayHours : ['6~7', '7~8', '8~9', '9~10', '10~11', '11~12', '12~13', '13~14', '14~15', '15~16', '16~17', '17~18', '18~19', '19~20'],
            hoursList : []
        }
    },
    methods : {
        setHour : function (day, range, employeeIndex) {

            var format = `${day},${range}`;
            var foundIndex = this.hoursList.indexOf(format);
            console.log(foundIndex);

            if (foundIndex == -1) {
                this.hoursList.push(format);
            }else {
                this.hoursList.splice(foundIndex, 1);
            }
            if (employeeIndex != -1) {
                this.agency.employees[employeeIndex].hours = this.hoursList;
            }
        },
        updateSchedule : function () {
            axios.put('api/employee/schedule/update/', this.hoursList).then( res => {
                if (res.data.success) {
                    swalSuccess();
                }
            });
        }
    },
    mounted : function () {
        if (this.employee.schedule) {
            this.hoursList = this.employee.schedule.split('&');
        }
    }
}
</script>

<style scoped>

.schedule {
    display: flex;
}

.schedule > div {
    text-align: center;
    border: 1px solid #000;
    padding: 10px;
    width: 6.66%;
}

.schedule > div:not(:first-child) {
    cursor: pointer;
    direction: ltr;
}

</style>
