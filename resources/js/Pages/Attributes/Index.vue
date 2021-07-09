<template>
	<breeze-authenticated-layout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Attributes
			</h2>
		</template>

		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
					<div class="p-6 bg-white border-b border-gray-200">
						<Alert />

						<button
							@click="openModal()"
							class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4"
						>Create New Attribute</button>

						<div class="flex flex-col">
							<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
								<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
									<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
										<table class="min-w-full divide-y divide-gray-200">
											<thead class="bg-gray-50">
												<tr>
													<th
														scope="col"
														class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
													>
														Name
													</th>
													<th
														scope="col"
														class="relative px-6 py-3"
													>
														<span class="sr-only">Edit</span>
													</th>
												</tr>
											</thead>
											<tbody class="bg-white divide-y divide-gray-200">
												<tr
													v-for="(row, index) in $page.props.attributes.data"
													:key="index"
												>
													<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
														{{ row .name }}
													</td>
													<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
														<button
															@click="edit(row)"
															class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 mr-2 rounded"
														>Edit</button>
														<button
															@click="deleteRow(row)"
															class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded"
														>Delete</button>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="mt-4" v-if="$page.props.attributes">
										<pagination
											class="mt-6"
											:links="$page.props.attributes.links"
										/>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div
			class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400"
			v-if="isOpen"
		>
			<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

				<div class="fixed inset-0 transition-opacity">
					<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
				</div>

				<span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
				<div
					class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
					role="dialog"
					aria-modal="true"
					aria-labelledby="modal-headline"
				>
					<form>
						<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
							<div class="">
								<div class="mb-4">
									<label
										for="exampleFormControlInput1"
										class="block text-gray-700 text-sm font-bold mb-2"
									>Name:</label>
									<input
										type="text"
										class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
										id="exampleFormControlInput1"
										placeholder="Enter name"
										v-model="form.name"
									>
									<div
										v-if="$page.props.errors.name"
										class="text-red-500"
									>{{ $page.props.errors.name }}</div>
								</div>
							</div>
						</div>
						<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
							<span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
								<button
									wire:click.prevent="store()"
									type="button"
									class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
									v-show="!editMode"
									@click="save(form)"
								>
									Save
								</button>
							</span>
							<span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
								<button
									wire:click.prevent="store()"
									type="button"
									class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
									v-show="editMode"
									@click="update(form)"
								>
									Update
								</button>
							</span>
							<span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

								<button
									@click="closeModal()"
									type="button"
									class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
								>
									Cancel
								</button>
							</span>
						</div>
					</form>

				</div>
			</div>
		</div>
	</breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import Pagination from "@/Components/Pagination";
import ButtonLink from "@/Components/ButtonLink";
import Alert from "@/Components/Alert";

export default {
	components: {
		BreezeAuthenticatedLayout,
		Pagination,
		ButtonLink,
		Alert,
	},

	data() {
		return {
			editMode: false,
			isOpen: false,
			form: {
				name: null,
			},
		};
	},

	methods: {
		openModal() {
			this.isOpen = true;
		},
		closeModal() {
			this.isOpen = false;
			this.reset();
			this.editMode = false;
			this.$page.props.errors = "";
		},
		reset() {
			this.form = {
				name: null,
				body: null,
			};
		},
		save(data) {
			this.$inertia.post(route("attributes.create"), data, {
				onSuccess: () => {
					this.closeModal();
				},
			});
		},
		edit(data) {
			this.form = Object.assign({}, data);
			this.editMode = true;
			this.openModal();
		},
		update(data) {
			this.$inertia.put(route("attributes.edit", { id: data.id }), data, {
				onSuccess: () => {
					this.closeModal();
				},
			});
		},
		deleteRow(data) {
			this.$inertia.delete(route("attributes.delete", { id: data.id }), {
				onBefore: () =>
					confirm("Are you sure you want to delete this attribute?"),
			});
		},
	},
};
</script>
