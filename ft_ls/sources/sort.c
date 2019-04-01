/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sort.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 15:06:12 by malallai          #+#    #+#             */
/*   Updated: 2019/04/01 15:14:06 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

void		sort(t_opt *opt, t_file *files, int low, int high)
{
	if (has_flag(opt, F_TIME))
		sort_time(files, low, high);
	else
		sort_ascii(files, low, high);
}

void		sort_ascii(t_file *file, int low, int high)
{
	int		pivot;
	int		i;
	int		j;

	if (low < high)
	{
		pivot = low;
		i = low;
		j = high;
		while (i < j)
		{
			while (i <= high && compare(0, get_file(file, i), \
				get_file(file, pivot), 1))
				i++;
			while (j >= low && compare(0, get_file(file, j), \
				get_file(file, pivot), 0))
				j--;
			if (i < j)
				swap(get_file(file, i), get_file(file, j));
		}
		swap(get_file(file, j), get_file(file, pivot));
		sort_ascii(file, low, j - 1);
		sort_ascii(file, j + 1, high);
	}
}

void		sort_time(t_file *file, int low, int high)
{
	int		pivot;
	int		i;
	int		j;

	if (low < high)
	{
		pivot = low;
		i = low;
		j = high;
		while (i < j)
		{
			while (i <= high && compare(1, get_file(file, i), \
				get_file(file, pivot), 1))
				i++;
			while (j >= low && compare(1, get_file(file, j), \
				get_file(file, pivot), 0))
				j--;
			if (i < j)
				swap(get_file(file, i), get_file(file, j));
		}
		swap(get_file(file, j), get_file(file, pivot));
		sort_time(file, low, j - 1);
		sort_time(file, j + 1, high);
	}
}

int			compare(int t, t_file *f1, t_file *f2, int i)
{
	if (t)
	{
		if (f1->infos->millis == f2->infos->millis)
			return (ft_strcmp(f1->name, f2->name) > 0);
		return (i ? f1->infos->millis >= f2->infos->millis \
			: f1->infos->millis < f2->infos->millis);
	}
	else
		return (i ? ft_strcmp(f1->name, f2->name) <= 0 \
			: ft_strcmp(f1->name, f2->name) > 0);
	return (0);
}
