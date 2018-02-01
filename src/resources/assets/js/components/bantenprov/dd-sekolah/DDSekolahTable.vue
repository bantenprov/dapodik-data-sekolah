<template>
    <div class="card p-3">
        <div class="table-header">
            <h4 class="table-title text-center mt-3">{{title}}</h4>
        </div>
        <div class="text-left">
            <div id="search-input-container">
                <label>
                    <input type="search" id="search-input" class="form-control mb-2" placeholder="Search data" v-model="searchInput">
                </label>
                <div class="actions float-right pr-4 mb-3">
                    <b-tooltip content="Tambah PDRB"><a class="btn btn-info pull-right" href="#/admin/dd-sekolah/create">Create</a></b-tooltip>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table ref="table" class="table">
                <thead>
                    <tr>
                        <th v-for="(column, index) in columns" @click="sort(index)" v-bind:key="sort(index)" :class="(sortable ? 'sortable' : '')
                            + (sortColumn === index ?
                                (sortType === 'desc' ? ' sorting-desc' : ' sorting-asc') : '')" :style="{width: column.width ? column.width : 'auto'}">
                            {{column.label}} <i class="fa float-right" :class="(sortColumn === index ?
                                (sortType === 'desc' ? ' ti-angle-down' : ' ti-angle-up') : '')"></i>
                        </th>
                        <slot name="thead-tr"></slot>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(row, index) in paginated" v-bind:key="(row,index)"  @click="click(row, index)">
                        <template v-for="column in columns">
                            <td :class="column.numeric ? 'numeric' : ''" v-bind:key="!column.html"  v-if="!column.html">
                                {{ collect(row,column.field) }}
                            </td>
                            <td :class="column.numeric ? 'numeric' : ''" v-html="collect(row, column.field)" v-bind:key="column.html" v-if="column.html">
                            </td>
                        </template>
                        <slot name="tbody-tr" :row="row"></slot>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="table-footer" v-if="paginate">
            <div class="datatable-length float-left pl-3">
                <span>Rows per page:</span>
                <select class="custom-select" v-model="currentPerPage">
                    <option v-for="len in pagelen" v-bind:key="len" :value="len">{{len}}</option>
                    <option value="-1">All</option>
                </select>
                <div class="datatable-info  pb-2 mt-3">
                    <span>Showing </span> {{(currentPage - 1) * currentPerPage ? (currentPage - 1) * currentPerPage : 1}} -{{currentPerPage==-1?processedRows.length:Math.min(processedRows.length, currentPerPage * currentPage)}} of {{processedRows.length}} <span>records</span>
                </div>
            </div>
            <div class="float-right">
                <ul class="pagination">
                    <li>
                        <a href="javascript:undefined" class="btn link" @click.prevent="previousPage" tabindex="0">
                            <i class="ti-angle-left"></i>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:undefined" class="btn link" @click.prevent="nextPage" tabindex="0">
                            <i class="ti-angle-right"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
import Fuse from 'fuse.js';
export default {
    props: {
        title: {
            default: ""
        },
        columns: {
            required: true
        },
        rows: {
            required: true
        },
        perPage: {
            default: 10
        },
        sortable: {
            default: true
        },
        paginate: {
            default: true
        },
        exportable: {
            default: true
        },
        pagelen: {
            type: Array,
            default () {
                return [5, 10, 20, 50]
            }
        }
    },

    data() {
        return {
            currentPage: 1,
            currentPerPage: this.perPage,
            sortColumn: -1,
            sortType: 'asc',
            searchInput: '',
        }
    },
    mounted() {
        this.sort(0);
    },
    methods: {
        nextPage() {
            if (this.processedRows.length > this.currentPerPage * this.currentPage && this.currentPerPage != -1)
                ++this.currentPage;
        },
        previousPage() {
            if (this.currentPage > 1)
                --this.currentPage;
        },
        sort(index) {
            if (!this.sortable) {
                return;
            }
            if (this.sortColumn === index) {
                this.sortType = this.sortType === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortType = 'asc';
                this.sortColumn = index;
            }
        },

        click(row, index) {
            this.$emit("rowClick", row, index);
        },

        exportExcel() {
            const mimeType = 'data:application/vnd.ms-excel';
            const html = this.renderTable().replace(/ /g, '%20');

            const d = new Date();

            var dummy = document.createElement('a');
            dummy.href = mimeType + ', ' + html;
            dummy.download = this.title.toLowerCase().replace(/ /g, '-') + '-' + d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate() + '-' + d.getHours() + '-' + d.getMinutes() + '-' + d.getSeconds() + '.xls';
            dummy.click();
        },

        renderTable() {
            var table = '<table><thead>';

            table += '<tr>';
            for (var i = 0; i < this.columns.length; i++) {
                const column = this.columns[i];
                table += '<th>';
                table += column.label;
                table += '</th>';
            }
            table += '</tr>';

            table += '</thead><tbody>';

            for (var i = 0; i < this.rows.length; i++) {
                const row = this.rows[i];
                table += '<tr>';
                for (var j = 0; j < this.columns.length; j++) {
                    const column = this.columns[j];
                    table += '<td>';
                    table += this.collect(row, column.field);
                    table += '</td>';
                }
                table += '</tr>';
            }

            table += '</tbody></table>';

            return table;
        },

        dig(obj, selector) {
            var result = obj;
            const splitter = selector.split('.');
            for (let i = 0; i < splitter.length; i++)
                if (typeof(result) === 'undefined')
                    return undefined;
                else
                    result = result[splitter[i]];
            return result;
        },

        collect(obj, field) {
            if (typeof(field) === 'function')
                return field(obj);
            else if (typeof(field) === 'string')
                return this.dig(obj, field);
            else
                return undefined;
        }
    },

    computed: {
        processedRows: function() {
            var computedRows = this.rows;

            if (this.sortable !== false) {
                computedRows = computedRows.sort((x, y) => {
                    if (!this.columns[this.sortColumn]) {
                        return 0;
                    }

                    const cook = (x) => {
                        x = this.collect(x, this.columns[this.sortColumn].field);
                        if (typeof(x) === 'string') {
                            x = x.toLowerCase();
                            if (this.columns[this.sortColumn].numeric)
                                x = x.indexOf('.') >= 0 ? parseFloat(x) : parseInt(x);
                        }
                        return x;
                    }

                    x = cook(x);
                    y = cook(y);

                    return (x < y ? -1 : (x > y ? 1 : 0)) * (this.sortType === 'desc' ? -1 : 1);
                })
            }

            if (this.searchInput) {
                computedRows = (new Fuse(computedRows, {
                    keys: this.columns.map(c => c.field)
                })).search(this.searchInput);
            }
            return computedRows;
        },

        paginated: function() {
            var paginatedRows = this.processedRows;
            if (this.paginate && this.currentPerPage != -1) {
                paginatedRows = paginatedRows.slice((this.currentPage - 1) * this.currentPerPage, this.currentPage * this.currentPerPage);
            }
            return paginatedRows;
        }
    },
    watch: {
        currentPerPage() {
            this.currentPage = 1;
            this.paginated;
        },
        searchInput(){
            this.currentPage = 1;
            this.paginated;
        }
    }
}
</script>
<style scoped>
.pagination {
    margin-top: 12px;
}

.sortable {
    cursor: pointer;
}
</style>
