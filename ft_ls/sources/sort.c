/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sort.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/18 15:29:16 by malallai          #+#    #+#             */
/*   Updated: 2019/03/18 15:44:21 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

void	split_entries(t_opt *opt)
{
	int index;
	int	folder_i;
	int	file_i;

	index = 0;
	folder_i = 0;
	file_i = 0;
	while (opt->entries->a[index])
	{
		if (!exist(opt->entries->a[index]))
		{
			print_nexist(opt->entries->a[index++]);
			continue ;
		}
		if (is_regular_file(opt->entries->a[index]))
			opt->files->a[file_i++] = ft_strdup(opt->entries->a[index]);
		else if (is_folder(opt->entries->a[index]))
			opt->folders->a[folder_i++] = ft_strdup(opt->entries->a[index]);
		index++;
	}
	opt->folders->count = folder_i;
	opt->files->count = file_i;
	max_size(opt);
}

void	max_size(t_opt *opt)
{
	int		index;
	int		len;

	index = 0;
	while (index < opt->files->count)
	{
		if ((len = (int)ft_strlen(opt->files->a[index])) > opt->files->max)
			opt->files->max = (int)len;
		index++;
	}
	index = 0;
	while (index < opt->folders->count)
	{
		if ((len = (int)ft_strlen(opt->folders->a[index])) > opt->folders->max)
			opt->folders->max = len;
		index++;
	}
}

void	swap(char **array, int a, int b)
{
	char *temp;

	temp = array[a];
	array[a] = array[b];
	array[b] = temp;
}

void	quicksort(char **array, int low, int high)
{
	int pivot;
	int i;
	int j;

	if (low < high)
	{
		pivot = low;
		i = low;
		j = high;
		while (i < j)
		{
			while (ft_strcmp(array[i], array[pivot]) < 0 && i <= high)
				i++;
			while (ft_strcmp(array[j], array[pivot]) > 0 && j >= low)
				j--;
			if (i < j)
				swap(array, i, j);
		}
		swap(array, j, pivot);
		quicksort(array, low, j - 1);
		quicksort(array, j + 1, high);
	}
}
