/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   solver.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/07 13:43:57 by malallai          #+#    #+#             */
/*   Updated: 2019/01/11 19:12:39 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

int			is_valid_char(char c)
{
	return (c == '.' || c == '#' || c == '\n');
}

int			read_tetris(t_infos *infos)
{
	int			r;
	char		*buffer;
	int			index;
	t_tetris	*tetris;

	index = 0;
	buffer = ft_strnew(22);
	if ((r = read(infos->fd, buffer, 21)))
	{
		buffer[21] = '\0';
		if (infos->size > 0)
			if (!new_tetris(infos))
				return (0);
		tetris = infos->last;
		while (buffer[index] && is_valid_char(buffer[index]))
		{
			tetris->array[infos->pos->y][infos->pos->x] = buffer[index] == \
			'\n' ? tetris->array[infos->pos->y][infos->pos->x] : buffer[index];
			edit_infos(infos, buffer[index++], 0);
		}
		if (!edit_infos(infos, buffer[index], 1) || index != 21)
			r = -1;
	}
	ft_strdel(&buffer);
	return (r >= 1 ? 1 : r);
}

void t(t_tetris *tetris)
{
	char *array = tetris->charl;
	char c = 'A' + tetris->id;
	int i = 0;

	while (i != 21)
	{
		if (array[i] == '.')
		{
			if ((i + 1 < 20 && array[i + 1] == c)
				|| (i + 2 < 20 && array[i + 2] == c))
			{

				if ((i + 5 < 20 && array[i + 5]  == c)
					|| (i - 5 >= 0 && array[i  - 5] == c))
					array[i] = ' ';
				if ((i + 10 <= 20 && array[i + 10]  == c)
					|| (i - 10 >= 0 && array[i  - 10] == c))
					array[i] = ' ';
			}
		}
		i++;
	}
	array = ft_strreplace(array, '.', 0);
	array = ft_trimchar(array, '\n');
	tetris->charl = array;
}

char **to_array(char *str) {
	char **array;
	int index;
	int str_index;
	int j;

	str_index = 0;
	index = 0;
	j = 0;
	array = (char **)malloc(sizeof(char **) * 4);
	while (index < 4)
	{
		array[index] = ft_strnew(4);
		while (str_index != 4 && str[j])
		{
			if (str[j] != '\n')
				array[index][str_index++] = str[j++];
			else
				break ;
		}
		array[index][str_index] = 0;
		str_index = 0;
		j++;
		index++;
	}
	return (array);
}

char *array_to_buff(char **array)
{
	char *tmp;
	int i;
	
	i = 0;
	tmp = ft_strnew(1);
	while (i < 4)
	{
		tmp = ft_strjoin(tmp, array[i++]);
		tmp = ft_strjoin(tmp, "\n");
	}
	return (tmp);
}

int				solve(t_infos *infos)
{
	t_map *map;
	t_tetris *next;

	map = new_map(infos);
	next = infos->tetris;
	while (next)
	{
		t(next);
		next = next->next;
	}
	
	next = infos->tetris;
	char **t;
	t = to_array(next->charl);
	int i = 0;
	int j = 0;
	int x = 0;
	ft_putendl(next->next->charl);
	while (next)
	{
		if (next->valid)
		{
			next = next->next;
			continue ;
		}
		if (next->next)
		{
			char **tmp;
			char **tmp2;

			tmp = to_array(next->charl);
			tmp2 = to_array(next->next->charl);
			while (i < 4)
			{
				if ((ft_strlen(t[i]) <= ft_strlen(tmp2[j])) && ft_strlen(t[i]) + ft_strlen(tmp2[i]) < 4)
					t[i] = ft_strjoin(t[i], tmp2[j++]);
				i++;
			}
			if (!j)
				x = 1;
			else
				next->valid = 1;
		}
		i = 0;
		j = 0;
		next = next->next;
	}
	if (x)
		next = infos->tetris;
	i = -1;
	while (++i < 4)
		while (ft_strlen(t[i]) < 4)
			t[i] = ft_strjoin(t[i], ".");
	char *test = array_to_buff(t);
	test = ft_strreplace(test, ' ', '.');
	test[21] = '\0';
	ft_putendl(test);

	return (1);
}

/*void	update_map(t_infos *infos)
{

}*/
