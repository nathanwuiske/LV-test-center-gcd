<template>
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <h3 class="card-title">User Issues</h3>
               </div>
               <div class="card-body table-responsive p-0">
                  <table class="table table-hover">
                     <tbody>
                        <tr>
                           <th>ID</th>
                           <th>Subject</th>
                           <th>Description</th>
                           <th>Resolved?</th>
                           <th></th>
                           <th style="width: 25%">Modify</th>
                        </tr>
                        <tr v-if="issues.data && issues.data.length === 0"><p style="text-align:center;color:#AD1707;">There are currently no user issues.</p></tr>
                        <tr v-for="issue in issues.data" :key="issue.created_at">
                           <td>{{issue.id}}</td>
                            <td class="truncateText">
                            <span>{{issue.subject}}</span>
                            </td>
                           <td class="truncateText">
                            <span>{{issue.description}}</span>
                            </td>
                           <td>{{issue.resolved | isResolved}}</td>
                           <td> <a href="#" @click="viewIssueModal(issue)">View</a> </td>
                           <td>
                              <a class="cursor-pointer" @click="deleteIssue(issue.id)"><i class="fas fa-trash red"></i></a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="card-footer">
                  <pagination :data="issues" @pagination-change-page="getResults" :limit=5>
                     <span slot="prev-nav">&lt; Previous</span>
                     <span slot="next-nav">Next &gt;</span>
                  </pagination>
               </div>
            </div>

            <!-- Modal for viewing issues -->
            <div class="modal fade" id="viewIssueModal" tabindex="-1" role="dialog">
               <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">View User Issue</h5>
                     </div>
                        <div class="modal-body">
                           <div class="form-group">
                              <label>Problem Subject</label>
                              <input v-model="issueForm.subject" type="text" name="subject" 
                                 class="form-control" :class="{ 'is-invalid': issueForm.errors.has('subject') }">
                              <has-error :form="issueForm" field="subject"></has-error>
                           </div>
                           <div class="form-group">
                              <label>Problem Description</label>
                              <textarea v-model="issueForm.description" type="text" name="description"
                                 class="form-control" :class="{ 'is-invalid': issueForm.errors.has('description') }"
                                 style="height: 25em;"> </textarea>
                              <has-error :form="issueForm" field="description"></has-error>
                           </div>
                        </div>
                        <!-- Footer -->
                        <div class="modal-footer">
                           <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                           <button v-show="issueForm.resolved == 1" type="submit" class="btn btn-warning" @click="unmarkResolved(issueForm.id) ">Unmark as Resolved</button>
                           <button v-show="issueForm.resolved == 0" type="submit" class="btn btn-success" @click="markResolved(issueForm.id) ">Mark as Resolved</button>
                        </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</template>

<script>
    export default {
        data() {
            return {
                issues: {},
                issueForm: new Form({
                    id: '',
                    subject: '',
                    description: '',
                    resolved: ''
                }),
                  overrideForm: new Form({
                    resolved: ''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/issue?page=' + page)
                    .then(response => {
                        this.issues = response.data;
                    });
            },
            getIssues() {
                axios.get('api/issue').then(({
                    data
                }) => (this.issues = data));
            },
            viewIssueModal(issue) {
                this.issueForm.clear();
                this.issueForm.reset();
                $('#viewIssueModal').modal('show');
                this.issueForm.fill(issue);
            },
            markResolved(id){
                    this.overrideForm.resolved = 1;
                    this.overrideForm.put('api/issue/' + this.issueForm.id)
                    .then(() => {
                        Fire.$emit('RefreshIssues');
                        $('#viewIssueModal').modal('hide');
                        swal.fire({
                           toast: true,
                           position: 'top',
                           showConfirmButton: false,
                           timer: 3500,
                           type: 'success',
                           title: 'Issue marked as resolved.'
                         })
                    })
                    .catch(() => {
                        swal.fire({
                            title: 'Error',
                            text: "Failed to mark issue as resolved.",
                            type: 'error'
                        })
                    })
            },
              unmarkResolved(id){
                    this.overrideForm.resolved = 0;
                    this.overrideForm.put('api/issue/' + this.issueForm.id)
                    .then(() => {
                        Fire.$emit('RefreshIssues');
                        $('#viewIssueModal').modal('hide');
                        swal.fire({
                           toast: true,
                           position: 'top',
                           showConfirmButton: false,
                           timer: 3500,
                           type: 'success',
                           title: 'Issue unmarked as resolved.'
                         })
                    })
                    .catch(() => {
                        swal.fire({
                            title: 'Error',
                            text: "Failed to unmark issue as resolved.",
                            type: 'error'
                        })
                    })
            },
            deleteIssue(id) {
                swal.fire({
                    title: 'Are you sure?',
                    html: 'Issue ID ' + id + ' will be permanently deleted',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#07AD4D',
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    if (result.value) {
                        this.issueForm.delete('api/issue/' + id).then(() => {
                        swal.fire({
                           toast: true,
                           position: 'top',
                           showConfirmButton: false,
                           timer: 3500,
                           type: 'success',
                           title: 'Issue has been successfully deleted'
                         })
                            Fire.$emit('RefreshIssues');
                        }).catch(() => {
                            swal("Failed!", "Failed to delete issue.", "warning");
                        });
                    }
                })
            },
            /* End of methods */
        }, 

        mounted() {
            Fire.$on('RefreshIssues', () => {
                this.getIssues();
            });
            this.getIssues();
        }
    } 
</script>