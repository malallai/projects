/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sort.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 18:56:57 by malallai          #+#    #+#             */
/*   Updated: 2019/03/17 16:38:01 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

void	split_entries(t_opt *opt)
{
	int index;
	int	folder_index;
	int	file_index;

	index = 0;
	folder_index = 0;
	file_index = 0;
	while (opt->entries->array[index])
	{
		if (is_regular_file(opt->entries->array[index]))
			opt->files->array[file_index++] = \
                ft_strdup(opt->entries->array[index]);
		else if (is_folder(opt->entries->array[index]))
			opt->folders->array[folder_index++] = \
                ft_strdup(opt->entries->array[index]);
		index++;
	}
    opt->folders->count = folder_index;
    opt->files->count = file_index;
}

void swap(char **array, int a, int b)
{
    char *temp;

    temp = array[a];
    array[a] = array[b];
    array[b] = temp;
}

void quicksort(char **array, int low, int high)
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