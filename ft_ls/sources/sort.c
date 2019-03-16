/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sort.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 18:56:57 by malallai          #+#    #+#             */
/*   Updated: 2019/03/16 19:41:15 by malallai         ###   ########.fr       */
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
	while (opt->argv[index])
	{
		if (is_regular_file(opt->argv[index]))
		{
			opt->files[file_index] = ft_strdup(opt->argv[index]);
			file_index++;
		}
		else if (is_folder(opt->argv[index]))
		{
			opt->folders[folder_index] = ft_strdup(opt->argv[index]);
			folder_index++;
		}
		index++;
	}
}

void swap(int *x,int *y)
{
    int temp;
    temp = *x;
    *x = *y;
    *y = temp;
}

int choose_pivot(int i,int j )
{
    return((i+j) /2);
}
 
void quicksort(int list[],int m,int n)
{
    int key,i,j,k;
    if( m < n)
    {
        k = choose_pivot(m,n);
        swap(&list[m],&list[k]);
        key = list[m];
        i = m+1;
        j = n;
        while(i <= j)
        {
            while((i <= n) && (list[i] <= key))
                i++;
            while((j >= m) && (list[j] > key))
                j--;
            if( i < j)
                swap(&list[i],&list[j]);
        }
        /* swap two elements */
        swap(&list[m],&list[j]);
 
        /* recursively sort the lesser list */
        quicksort(list,m,j-1);
        quicksort(list,j+1,n);
    }
}

void	sort_files(t_opt *opt)
{

}
