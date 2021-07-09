<template>
	<breeze-authenticated-layout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Files
			</h2>
		</template>

		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
					<div class="p-6 bg-white border-b border-gray-200">
						<Alert />

						<div class="flex">
							<inertia-link
								:href="route('files.create')"
								class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4"
							>Create New File</inertia-link>
						</div>

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
													v-for="(row, index) in $page.props.files.data"
													:key="index"
												>
													<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
														{{ row.name }}
													</td>
													<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">

														<inertia-link
															:href="route('files.edit', row.id)"
															class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 mr-2 rounded"
														>Edit</inertia-link>
														<a
															href="javascript:void(0)"
															@click="deleteRow(row)"
															class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded"
														>Delete</a>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="mt-4">
										<pagination
											class="mt-6"
											:links="$page.props.files.links"
										/>
									</div>
								</div>
							</div>
						</div>
					</div>
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
		deleteRow(data) {
			this.$inertia.delete(route("files.delete", { id: data.id }), {
				onBefore: () => confirm("Are you sure you want to delete this file?"),
			});
		},
	},
};
</script>
